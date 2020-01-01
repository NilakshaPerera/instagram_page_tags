@extends('layouts.admin')

@section('content')

<style>
    .insta-item {
        margin-bottom: 30px;
    }

    .insta-item-media {
        width: 100%;
        height: 280px;
        background-position: center center;
        background-size: cover
    }

    .insta-caption {
        text-align: center;
        padding: 5px 5px;
        color: #fff;
        margin-top: -40px;
        background-color: rgba(0, 0, 0, 0.7);
        position: relative;
    }

    .insta-action-pane {
        margin-top: 15px;
        padding-left: 5px;
        padding-right: 5px;
        text-align: center;
    }

    .insta-action-pane,
    input {
        vertical-align: text-bottom;
    }
</style>

<div class="col-md-12 text-right">
    <div class="row">
        <div class="col-lg-6"></div>
        <div class="col-lg-6">
            <form id="frmpull" name="frmpull" action="" method="POST">
                {{ csrf_field() }}
                <div class="input-group">
                    <select name="selbusinessacc" id="" type="text" class="form-control">
                        @foreach( \App\BusinessAccounts::all() as $account)
                        <option id="acc-{{$account->id}}" value="{{$account->id}}">{{$account->facebookauth->account_name}}</option>
                        @endforeach
                    </select>
                    <span class="input-group-btn">
                        <input class="btn btn-default" type="submit" value="Pull Instagram Posts">
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="x_panel">
    <h2>Instagram Page Posts</h2>
    <div class="x_content">
        <div class="text-right row">
            <button id="btnAddSelected" type="button" title="Add Selected" class="btn btn-default">+</button>
        </div>
        <div class="text-center row" id="temp-posts" name="temp-posts">
        </div>
    </div>
</div>

<div class="x_panel">
    <h2>Instagram Selected Posts</h2>
    <div class="x_content">
        <div class="text-right row">
            <button id="btnDeleteSelected" type="button" title="Remove Selected" class="btn btn-default">-</button>
        </div>
        <div class="text-center row" id="saved-posts" name="saved-posts">
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    getTemp();
    getSaved();

    function getTemp() {
        var data = $('#logout-form').serialize();
        $.ajax({
            url: base + "/dashboard/temp",
            type: 'post',
            data: data,
            success: function(respond) {
                if (respond.success) {
                    $('#temp-posts').html(respond.data);
                } else {
                    alert('An error occured! Please contact the venodr or try again in a few minutes');
                }
            },
            complete: function() {}
        });
    }

    function getSaved() {
        var data = $('#logout-form').serialize();
        $.ajax({
            url: base + "/dashboard/saved",
            type: 'post',
            data: data,
            success: function(respond) {
                if (respond.success) {
                    $('#saved-posts').html(respond.data);
                } else {
                    alert('An error occured! Please contact the venodr or try again in a few minutes');
                }
            },
            complete: function() {}
        });
    }

    $('#frmpull').submit(function(e) {
        e.preventDefault();
        var data = $('#frmpull').serialize();
        $.ajax({
            url: base + "/account/pull",
            type: 'post',
            data: data,
            success: function(respond) {
                if (respond.success) {
                    getTemp();
                    getSaved();
                
                } else {
                    alert('An error occured! Please contact the venodr or try again in a few minutes');
                }
                console.log(respond.data)
            },
            complete: function() {}
        });

    });

    $('#btnAddSelected').click(function(){
        var data = $('#frmpull').serialize();
        data += '&arr='+ selectedarray;
        $.ajax({
            url: base + "/dashboard/save",
            type: 'post',
            data: data,
            success: function(respond) {
                if (respond.success) {
                    getTemp();
                    getSaved();
                
                } else {
                    alert('An error occured! Please contact the venodr or try again in a few minutes');
                }
                console.log(respond.data + 'selected')
            },
            complete: function() {}
        });
    });

    $('#btnDeleteSelected').click(function(){
        var data = $('#frmpull').serialize();
        data += '&arr='+ deletearray;
        $.ajax({
            url: base + "/dashboard/delete",
            type: 'post',
            data: data,
            success: function(respond) {
                if (respond.success) {
                    getTemp();
                    getSaved();
                
                } else {
                    alert('An error occured! Please contact the venodr or try again in a few minutes');
                }
                console.log(respond.data)
            },
            complete: function() {}
        });
    });


</script>
@endsection