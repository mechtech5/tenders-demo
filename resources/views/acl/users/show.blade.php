@extends('layouts.master')
@section('title','Welcom: To Admin Panel')
@section('meta')
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

@endsection
@section('content')

 <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i>ACL</h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">ACL</a></li>
      </ul>
    </div>
    <div class="col-md-12 m-auto">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-12 col-xl-12 col-sm-12 d-inline-flex radio-group" style=" ">

                <a style="background: #5bc0de;margin-right: 20px;max-width: 90px;" data = 'role' class="col-md-6 col-sm-6 text-center btn big active_class get_table roles_table">
                Roles</a>

                <a style="background: #5bc0de;margin-right: 20px;max-width: 100px;" data = 'permissions_table' class="col-md-6 col-sm-6 text-center btn big get_table permissions_table">
                Permissions</a>
            </div>
          </div>        
        </div>

        <div class="card-body "  >
          <div class="row mytable1">
          <div class="col-md-12 m-auto">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-3 col-sm-3">
                    <label>Name</label><br>
                    <span><?php echo($data['user']['name']);?></span>
                    <input id="id" type="hidden" name="id" value="<?php echo($data['user']['id']);?>">
                  </div>
                  <div class="col-sm-9 col-md-9">
                    <label>Roles</label>
                    <form>
                      <?php
                      foreach($data['role'] as $roles){ ?>
                        <label class="checkbox-inline mr-1 ml-1">{{$roles->name}}</label>
                          <input class="taskchecker" 
                          type="checkbox" name="role_val" <?php if(in_array($roles->id,$role_ids)){echo 'checked'; }?> value="{{$roles->id}}">                        
                     <?php } ?>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div style="display: none;" class="row mytable2" >
          <div class="col-md-12 m-auto">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-3 col-sm-3">
                    <label>Name</label><br>
                    <span><?php echo $data['user']['name'] ; ?></span>
                    <input id="id" type="hidden" name="id" value="<?php echo $data['user']['id'] ; ?>">
                  </div>
                  <div class="col-sm-9 col-md-9">
                    <label >Permissions</label>
                    <form>
                    <?php foreach($data['permissions'] as $permission){ ?>
                        <label class="checkbox-inline mr-1 ml-1">{{$permission->name}}</label>
                          <input name="permission_id" class="taskchecker1" <?php if(in_array($permission->id,$permission_ids)){echo 'checked'; }?>
                          type="checkbox" value="{{$permission->id}}">
                        
                    <?php } ?>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</main>     
<script>
  $(document).ready(function(){
    $('#role_table2').DataTable();

    $(".taskchecker").on("change", function() {
        var id  = $('#id').val();
        var val = [];        
        
          $("input[name='role_val']:checked").each(function(){
              val.push($(this).val());
           });
                  
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
           });
        $.post("/changes_role", {'userId':id, 'roleId':val}, function() {

        });
    })

    $('.roles_table,.permissions_table,.users_table').on('click',function(){
      var mylawyers = $(this).attr('data');
      
      if(mylawyers=='role'){
        $('.mytable1').show();
        $('.mytable2').hide();        
      }
    else if(mylawyers == 'users_table'){
        $('.mytable1').hide();
        $('.mytable2').hide();
      }
      else if(mylawyers == 'permissions_table'){
        $('.mytable1').hide();
        $('.mytable2').show();
      }
    });

    $(".taskchecker1").on("change", function() {
        var id  = $('#id').val();
        var val = [];

          $("input[name='permission_id']:checked").each(function(i){
              val.push($(this).val());
           });
          
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
           });
        $.post("/changePermission", {'userId':id, 'permissionId':val}, function() {

        });
    })
  })
</script>

@endsection
