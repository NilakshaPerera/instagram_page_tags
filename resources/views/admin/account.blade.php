@extends('layouts.admin')
@section('content')

<div class="">
    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
        <a class="btn btn-success" href="{{ htmlspecialchars($url) }}">Add Accounts</a>
    </div>
</div>
<div class="d-flex justify-content-center">
    @if(isset($pages) && $pages)
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <form id="frmAddAccounts" name="frmAddAccounts" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select class="js-example-basic-multiple form-control" name="facebookaccounts[]" multiple="multiple">
                                @foreach($pages as $page)
                                <option value="{{ $page['id'] }}">{{ $page['name'] }} - {{ $page['category'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input name="id" id="id" type="hidden" value="{{  $id }}" >
                    <div class="form-group">
                        <div class="form-check text-right">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_content">
            <div class="table-responsive">
                <table id="jstable" name="jstable" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                        <tr class="headings">
                            <th class="column-title" style="display: table-cell;">Date Time</th>
                            <th class="column-title" style="display: table-cell;">App Name</th>
                            <th class="column-title" style="display: table-cell;">Instagram Business ID</th>
                            <th class="column-title" style="display: table-cell;">Facebook ID</th>
                            <th class="bulk-actions" colspan="7" style="display: none;">
                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt">1 Records Selected</span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( \App\BusinessAccounts::all() as $account)
                        <tr class="even pointer">
                            <td class=" ">{{ $account->created_at }}</td>
                            <td class=" ">{{ $account->facebookauth->account_name }}</td>
                            <td class=" ">{{ $account->instagram_business_id }}</td>
                            <td class=" ">{{ $account->facebook_page_id }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

    $('#frmAddAccounts').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            url: base + "/account/callback/addaccounts",
            type: 'post',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(respond) {
                if (respond.success) {
                    alert('Success');
                    window.location.href = base + '/account'
                } else {
                    alert('An error occured! Please contact the venodr or try again in a few minutes');
                }
            },
            complete: function() {}
        });
    });
</script>

@endsection