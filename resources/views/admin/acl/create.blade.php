@extends('layouts.admin')

@section('tittle','Create Acl')

@section('css')


@endsection


@section('content')

<div class="content">
    <!-- content HEADER -->
    <!-- ========================================================= -->
    <div class="content-header">
        <!-- leftside content header -->
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Tables</a></li>
                <li><a>Data-table</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row animated fadeInRight">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <form class="form-group" name="acl_form" action="{{route('acl.store')}}" method="post">

                    @csrf

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="role_name" id="role_name" placeholder="Role name" required />
                        </div>

                        <div class="col-md-1">
                            <button class="btn btn-md btn-primary" type="submit">Save</button>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-12">

                            <table class="table table-stripped table-boarderd">

                                <thead>
                                    <th style="width: 60%;">Menu</th>
                                    <th>View</th>
                                    <th><span style="position: relative; top: -7%;" >All Widgets :</span></th>
                                    <th><input type="checkbox" onclick="toggle(this)"  name="role_click" id="role_click" placeholder="Role name"  /></th>
                                </thead>

                                <tbody>

                                    <tr>
                                        <td> ক্যাটেগরি-সাব-ক্যাটেগরি </td>

                                        <td>
                                            <input type="checkbox" name="widget[]" value="category" />
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        <td> পোস্ট </td>

                                        <td>
                                            <input type="checkbox" name="widget[]" value="posts" />
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td> কমেন্ট </td>

                                        <td>
                                            <input type="checkbox" name="widget[]" value="comments" />
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td> ইউজার </td>

                                        <td>
                                            <input type="checkbox" name="widget[]" value="users" />
                                        </td>
                                        
                                    </tr>
                                     <tr>
                                        <td> ACL </td>

                                        <td>
                                            <input type="checkbox" name="widget[]" value="acl" />
                                        </td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>   
                </div>
            </div>

            
        </div>
    </div>
</div>


@endsection

@section('js')

<script type="text/javascript">
		function toggle(source) {
			var n,i;
			var checkboxes1 = document.getElementsByName('widget[]');
			for(var i=0, n=checkboxes1.length;i<n;i++) {
				checkboxes1[i].checked = source.checked;
			}
		}
</script>

@endsection