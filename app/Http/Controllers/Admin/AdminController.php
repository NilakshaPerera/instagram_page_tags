<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Setting;
use Validator;
use Exception;
use App\FacebookAuth;
use App\BusinessAccounts;
use App\Post;
use App\TempPost;
use Auth;

class AdminController extends Controller
{
  private $fb;
  private $loginUrl;
  private $helper;

  private $appId;
  private $appSecret;
  private $graphVersion;
  private $redirUrl;

  public function __construct()
  {

    $this->middleware(['auth']);

    if (!session_id()) {
      session_start();
    }

    $this->appId = Setting::where('setting', 'app_id')->first()->data;
    $this->appSecret  =  Setting::where('setting', 'app_secret')->first()->data;
    $this->graphVersion =  Setting::where('setting', 'default_graph_version')->first()->data;
    $this->redirUrl = Setting::where('setting', 'redirect_url')->first()->data;


    $this->fb = new \Facebook\Facebook([
      'app_id' =>  $this->appId, // Replace {app-id} with your app id
      'app_secret' => $this->appSecret,
      'default_graph_version' => $this->graphVersion,
    ]);

    $this->helper = $this->fb->getRedirectLoginHelper();
    $permissions = ['email', 'instagram_basic', 'pages_show_list', 'instagram_manage_comments']; // Optional permissions
    $this->loginUrl = $this->helper->getLoginUrl($this->redirUrl, $permissions);
  }

  public function index()
  {
    return view('admin.account')->with(['url' => $this->loginUrl, 'pages' => false]);
  }

  public function callback(Request $request)
  {
    $accessToken = "";
    $tokenMetadata = '';
    $accessTokenL = '';

    try {
      $accessToken = $this->helper->getAccessToken();
    } catch (\Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch (\Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }

    try {

      if (!isset($accessToken)) {
        if ($this->helper->getError()) {
          header('HTTP/1.0 401 Unauthorized');
          echo "Error: " . $this->helper->getError() . "\n";
          echo "Error Code: " . $this->helper->getErrorCode() . "\n";
          echo "Error Reason: " . $this->helper->getErrorReason() . "\n";
          echo "Error Description: " . $this->helper->getErrorDescription() . "\n";
        } else {
          header('HTTP/1.0 400 Bad Request');
          echo 'Bad request';
        }
        exit;
      }

      // Logged in
      // echo '<h3>Access Token</h3>';
      // var_dump($accessToken->getValue());

      // The OAuth 2.0 client handler helps us manage access tokens
      $oAuth2Client = $this->fb->getOAuth2Client();

      // Get the access token metadata from /debug_token
      $tokenMetadata = $oAuth2Client->debugToken($accessToken);
      // echo '<h3>Metadata</h3>';
      // var_dump($tokenMetadata);

      // Validation (these will throw FacebookSDKException's when they fail)
      $tokenMetadata->validateAppId($this->appId); // Replace {app-id} with your app id
      // If you know the user ID this access token belongs to, you can validate it here
      //$tokenMetadata->validateUserId('123');
      $tokenMetadata->validateExpiration();

      if (!$accessToken->isLongLived()) {
        // Exchanges a short-lived access token for a long-lived one
        try {
          $accessTokenL = $oAuth2Client->getLongLivedAccessToken($accessToken);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
          echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
          exit;
        }
        //  echo '<h3>Long-lived</h3>';
        //   var_dump($accessTokenL->getValue());
      }

      // $_SESSION['fb_access_token'] = (string) $accessToken;
      $accounts = $this->getAccounts($accessToken);

      foreach ($accounts as $account) {

        $fbAuth = FacebookAuth::where('account_id', $account->getProperty('id'))
          ->where('user_id', Auth::user()->id)->first();
        if (!$fbAuth) {
          $fbAuth = FacebookAuth::create([
            'user_id' => Auth::user()->id,
            'access_token' => $accessToken,
            'long_lived_access_token' => $accessTokenL,
            'meta_data' => json_encode($tokenMetadata),
            'accounts' => $account,
            'account_id' => $account->getProperty('id'),
            'account_name' => $account->getProperty('name')
          ]);
        } else {
          $fbAuth = FacebookAuth::where('account_id', $account->getProperty('id'))
            ->where('user_id', Auth::user()->id)
            ->update([
              'access_token' => $accessToken,
              'long_lived_access_token' => $accessTokenL,
              'meta_data' => json_encode($tokenMetadata),
              'accounts' => $account,
              'account_name' => $account->getProperty('name')
            ]);
        }
      }


      return view('admin.account')->with(['url' => $this->loginUrl, 'pages' => $accounts, 'id' => $accessToken]);

      // User is logged in with a long-lived access token.
      // You can redirect them to a members-only page.
      //header('Location: https://example.com/members.php');
    } catch (Exception $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
  }

  function getAccounts($token)
  {
    try {
      // Returns a `FacebookFacebookResponse` object
      $response = $this->fb->get(
        '/me/accounts',
        $token
      );
    } catch (FacebookExceptionsFacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch (FacebookExceptionsFacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
    // return $graphNode = $response->getGraphNode();
    return $graphNode = $response->getGraphEdge();
    /*{
            "data": [
              {
                "access_token": "EAAHPNzClktwBAIj3DNb1mPmOZAOgqsEaZCZAXPmLzL7ochwZA24jTqhCc2jphgVI5TU303xYZBLZC5gzm65keFx5BhEqWJJAFqPFAIZCrXLYKPlSxEalLmgzuh70fjZBmZCzA8W6LCWXZBxKVhpQmSyzZBjCp1cOqusjWMr23pjnEWmG2Xghtu3H1KsnDrCZCrb8PNIZD",
                "category": "Shopping & Retail",
                "category_list": [
                  {
                    "id": "200600219953504",
                    "name": "Shopping & Retail"
                  },
                  {
                    "id": "1153901557995608",
                    "name": "Supermarket"
                  }
                ],
                "name": "Keells",
                "id": "108836225822670", // Need to pass this !
                "tasks": [
                  "ANALYZE",
                  "ADVERTISE",
                  "MODERATE",
                  "CREATE_CONTENT",
                  "MANAGE"
                ]
              }
            ],
            "paging": {
              "cursors": {
                "before": "MTA4ODM2MjI1ODIyNjcw",
                "after": "MTA4ODM2MjI1ODIyNjcw"
              }
            }
          }*/
  }

  function getInstagramBusinessAccount($token, $pageIds)
  {
    try {
      foreach ($pageIds as $page) {
        // Returns a `FacebookFacebookResponse` object
        $response = $this->fb->get(
          '/' . $page . '?fields=instagram_business_account',
          $token
        );

        $graphNode = $response->getGraphNode();

        $fbAuth = FacebookAuth::where('account_id', $page)
          ->where('user_id', Auth::user()->id)->first();

        if (!$fbAuth) {
          continue;
        }

        $ba = BusinessAccounts::where('facebook_auths_id',  $fbAuth->id)->first();
        $queryNode = $this->buildQueryId($token, $graphNode['instagram_business_account']['id']);

        if (!$ba) {
          BusinessAccounts::create([
            'facebook_auths_id' => $fbAuth->id,
            'instagram_business_id' =>  $graphNode['instagram_business_account']['id'],
            'facebook_page_id' => $graphNode['id'],
            'query_id' => $queryNode[0]['id'],
          ]);
        } else {
          BusinessAccounts::where('facebook_auths_id',  $fbAuth->id)
            ->update([
              'instagram_business_id' =>  $graphNode['instagram_business_account']['id'],
              'facebook_page_id' => $graphNode['id'],
              //'facebook_auths_id' => 1,
              'query_id' => $queryNode[0]['id'],
            ]);
        }
      }
    } catch (FacebookExceptionsFacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch (FacebookExceptionsFacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }

    /*
          {
          "instagram_business_account": {
              "id": "17841400637792448" // Need  to return this
              },
            " id": "108836225822670"
          }
          */
  }

  function buildQueryId($token, $businessId)
  {
    try {
      // Returns a `FacebookFacebookResponse` object
      $response = $this->fb->get(
        '/ig_hashtag_search' . '?user_id=' . $businessId . '&q=' . Setting::where('setting', 'hashtag')->first()->data,
        $token
      );
    } catch (FacebookExceptionsFacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch (FacebookExceptionsFacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
    // return $graphNode = $response->getGraphNode();
    return $graphNode = $response->getGraphEdge();
    /*
    {
  "data": [
    {
      "id": "17843702131033963" // search by this 
    }
  ]

}*/
  }

  function getPageTags($businessId, $token)
  {
    try {
      // Returns a `FacebookFacebookResponse` object
      $response = $this->fb->get(
        '/' . $businessId . '/tags?fields=id,username,caption,media_url,like_count,comments_count,media_type,permalink,timestamp',
        $token
      );
    } catch (FacebookExceptionsFacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch (FacebookExceptionsFacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
    // return $graphNode = $response->getGraphNode();
    return $graphNode = $response->getGraphEdge();
  }

  function getTopMedia($queryId, $token, $userId)
  {
    try {
      // Returns a `FacebookFacebookResponse` object
      $response = $this->fb->get(
        '/' . $queryId . '/top_media',
        $token
      );
    } catch (FacebookExceptionsFacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch (FacebookExceptionsFacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
    $graphNode = $response->getGraphNode();
    /*
{
  "data": [
    {
      "id": "17893854787367269"
    },
    {
      "id": "17943129883308373"
    },
    {
      "id": "17843541805045514"
    },
    {
      "id": "18076197337027771"
    },
    {
      "id": "17976081670206349"
    },
    {
      "id": "17990437522207018"
    },
    {
      "id": "17875565449216549"
    },
    {
      "id": "18099774844010048"
    },
    {
      "id": "17955318685147850"
    },
    {
      "id": "18002301367252733"
    },
    {
      "id": "17945573155199417"
    },
    {
      "id": "18025023046105277"
    },
    {
      "id": "18118413853029388"
    },
    {
      "id": "18058459489166693"
    },
    {
      "id": "17966354356070672"
    },
    {
      "id": "17842535605008040"
    },
    {
      "id": "17915989843021985"
    },
    {
      "id": "17844179020752165"
    },
    {
      "id": "17894906809043499"
    },
    {
      "id": "18023786854227540"
    },
    {
      "id": "17899614451259939"
    },
    {
      "id": "17842538764008040"
    },
    {
      "id": "17873133985135627"
    }
  ],
  "paging": {
    "cursors": {
      "after": "YTkzZAWZAiMGYwOWJkNDFmYWEwYzVmM2Q0MDRlOTEyMmEZD"
    },
    "next": "https://graph.facebook.com/v5.0/17843702131033963/top_media?access_token=EAAHPNzClktwBAPfsENKkxTLz9G3w1c4kCsVFY1WwceWgvnlkSYqyYvEZCnzaHWlXlJQdP1fO4Sm93D7C5bztjVJUbHp9LK341K7DSYpZCZCgDGsdA6r2cq5doZArfj7ZBdCA7ZCwmgGby4weXlERhlaZCW57MW8WwWKaZAM84IMLPiI4GfHIGRmI&pretty=0&user_id=17841400637792448&limit=25&after=YTkzZAWZAiMGYwOWJkNDFmYWEwYzVmM2Q0MDRlOTEyMmEZD"
  }
}
 */
  }

  function pullData(Request $request)
  {

    $account = $request['selbusinessacc'];
    $i = '';
    $ba = BusinessAccounts::where('id', $account)->first();
    $data =  $this->getPageTags($ba->instagram_business_id, $ba->facebookauth->access_token);
    $savedIds =  [];
    $tempIds = [];
    foreach (Post::where('business_accounts_id', $ba->id)->get() as $post) {
      array_push($savedIds, $post->postid);
    }
    foreach (TempPost::where('business_accounts_id', $ba->id)->get() as $temppost) {
      array_push($tempIds, $temppost->postid);
    }

    if ($data) {
      foreach ($data as $d) {
        if (in_array($d->getProperty('id'),  $savedIds)) {

          Post::where('business_accounts_id', $ba->id)
            ->where('postid', $d->getProperty('id'))
            ->update([
              'caption' => $d->getProperty('caption'),
              'media_url' => $d->getProperty('media_url'),
              'like_count' => $d->getProperty('like_count'),
              'comments_count' => $d->getProperty('comments_count'),
              'media_type' => $d->getProperty('media_type'),
              'permalink' => $d->getProperty('permalink'),
              'timestamp' => $d->getProperty('timestamp'),
            ]);
        } else if (in_array($d->getProperty('id'),  $tempIds)) {
          TempPost::where('business_accounts_id', $ba->id)
            ->where('postid', $d->getProperty('id'))
            ->update([
              'caption' => $d->getProperty('caption'),
              'media_url' => $d->getProperty('media_url'),
              'like_count' => $d->getProperty('like_count'),
              'comments_count' => $d->getProperty('comments_count'),
              'media_type' => $d->getProperty('media_type'),
              'permalink' => $d->getProperty('permalink'),
              'timestamp' => $d->getProperty('timestamp'),
            ]);
        } else {

          TempPost::create([

            'business_accounts_id' => $ba->id,
            'postid' => $d->getProperty('id'),
            'username' => $d->getProperty('username'),
            'caption' => $d->getProperty('caption'),
            'media_url' => $d->getProperty('media_url'),
            'like_count' => $d->getProperty('like_count'),
            'comments_count' => $d->getProperty('comments_count'),
            'media_type' => $d->getProperty('media_type'),
            'permalink' => $d->getProperty('permalink'),
            'timestamp' => $d->getProperty('timestamp'),
          ]);
        }
      }
    }

    return response()->json([
      'success' => true,
      'data' =>  "success"
    ]);
  }

  function addAccounts(Request $request)
  {
    $this->getInstagramBusinessAccount($request['id'],  $request['facebookaccounts']);
    return response()->json([
      'success' => true,
      'data' => $request['facebookaccounts']
    ]);
  }

  /**
   * Created By : Nilaksha
   * Created At : 26-4-2019
   * Summary  : saves all the settings 
   * @param Request $request
   */
  function updateSettings(Request $request)
  {
    $settings = Setting::all();
    $validateArray = [];
    $valArray = [];

    foreach ($settings as $setting) {
      $validateArray[$setting->setting] = 'required';
      $valArray[$setting->setting] = $request[$setting->setting];
    }

    $validator = Validator::make($request->all(), $validateArray);

    if ($validator->fails()) {
      return array(
        'success' => false,
        'errors' => $validator->errors()->all(),
      );
    }

    foreach ($valArray as $index => $value) {
      Setting::where('setting', $index)
        ->update(['data' => $value]);
    }
    return array(
      'success' => true,
    );
  }
}
