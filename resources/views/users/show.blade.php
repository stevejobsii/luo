@extends('app')
@section('content')
    @include('users.partials.infonav', ['current' => 'basicinfo'])
	  <style>
	  body {
	      position: relative;
	  }
	  ul.nav-pills {
	      position: fixed;
	  }
	  </style>


  <div class="row">
    <nav class="col-md-2" id="myScrollspy">
      <ul class="nav nav-pills nav-stacked">
      <h3>用户中心</h3>
        <li class="active"><a href="#section1">Section 1</a></li>
        <li><a href="#section2">Section 2</a></li>
        <li><a href="#section3">Section 3</a></li>
      </ul>
    </nav>

    <div class="col-md-10">
      <div id="section1">    
        <form class="form-horizontal" id="user-data-form">
                <h4><i class="glyphicon glyphicon-tasks"></i>&nbsp;&nbsp;个人信息</h4>
                <hr>
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">个性签名</label>
                    <div class="col-sm-6">
                        <input type="text" id="title" name="title" placeholder="个性签名" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="info" class="col-sm-2 control-label">个人介绍</label>
                    <div class="col-sm-6">
                        <textarea id="info" name="info" placeholder="" class="form-control" rows="10"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                    {{csrf_field()}}
                    <button type="button" class="btn btn-primary" id="update-user-data">更新</button>
                    </div>
                </div>
        </form>
      <br>
      </div>


      <div id="section2"> 
        <form class="form-horizontal" method="post" action="/settings/update-avatar" enctype="multipart/form-data" target="upload-frame" id="avatar-form">
                <h4><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;头像设置</h4>
                <hr>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                    <img src="" id="avatar_0"><img src="" id="avatar_1">          
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                    <label for="new_paavatarssword" class="control-label"></label>
                    <button type="button" class="btn btn-primary" onclick="$('#avatar').click()">
                        上传新头像
                    </button>
                    <span class="loading"></span>
                    <input type="file" id="avatar" name="avatar" size="1" style="display: none">
                    <span class="help-block">
                        头像支持jpg和png格式，上传的文件大小不超过 2M</span>
                    <button type="submit" class="btn btn-primary hidden" id="avatar-submit">更新</button>
                    </div>
                </div>
            </form>
            <br>
      </div> 



      <div id="section3">         
       <form class="form-horizontal" id="password-form">
            <h4><i class="glyphicon glyphicon-wrench"></i>&nbsp;&nbsp;密码设置</h4>
                <hr>
                <div class="form-group">
                    <label for="old_password" class="col-sm-2 control-label">当前密码</label>
                    <div class="col-sm-4">
                    <input type="password" id="old_password" name="old_password" placeholder="请输入您当前的密码" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="new_password" class="col-sm-2 control-label">新密码</label>
                    <div class="col-sm-4">
                    <input type="password" id="new_password" name="new_password" placeholder="请输入新密码" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="new_password" class="col-sm-2 control-label">密码确认</label>
                    <div class="col-sm-4">
                    <input type="password" id="new_password2" name="new_password2" placeholder="请再次输入新密码" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <label for="update-password" class="pure-checkbox">
                            <button type="button" class="btn btn-primary" id="update-password">更新
                            </button>
                            <span class="loading"></span>
                        </label>
                        <input type="hidden" name="csrf_token" value="3fc44390">
                    </div>
                </div>
            </form>
      </div>

    </div>
  </div>

@stop
