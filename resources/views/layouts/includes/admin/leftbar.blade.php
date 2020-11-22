<div class="left-sidebar">
                <!-- left sidebar HEADER -->
                <div class="left-sidebar-header">
                    <div class="left-sidebar-title">Navigation</div>
                    <div class="left-sidebar-toggle c-hamburger c-hamburger--htla hidden-xs" data-toggle-class="left-sidebar-collapsed" data-target="html">
                        <span></span>
                    </div>
                </div>
                <!-- NAVIGATION -->
                <!-- ========================================================= -->
                <div id="left-nav" class="nano">
                    <div class="nano-content">
                        <nav>
                            <ul class="nav nav-left-lines" id="main-nav">
                                <!--HOME-->
                                <li class="active-item"><a href="{{route('admin.home')}}"><i class="fa fa-home" aria-hidden="true"></i><span> ড্যাশবোর্ড </span></a></li>
                                @if(permission_check(Auth::user()->role_id,"category"))
                                <li><a href="{{route('category.home')}}"><i class="fa fa-menu" aria-hidden="true"></i><span>ক্যাটেগরি-সাব-ক্যাটেগরি</span></a></li>
                                @endif
                                @if(permission_check(Auth::user()->role_id,"posts"))
                                <li><a href="{{route('post.index')}}"><i class="fa fa-book" aria-hidden="true"></i><span>পোস্ট :</span></a></li>   
                                @endif
                                @if(permission_check(Auth::user()->role_id,"comments"))
                                <li><a href="{{ route('admin.comments') }}"><i class="fa fa-comment" aria-hidden="true"></i><span>কমেন্ট </span></a></li>   
                                @endif
                                 @if(permission_check(Auth::user()->role_id,"users"))
                                <li><a href="{{route('users.index')}}"><i class="fa fa-users" aria-hidden="true"></i><span>ইউজার</span></a></li> 
                                @endif
                                @if(permission_check(Auth::user()->role_id,"acl"))
                                <li><a href="{{route('acl.index')}}"><i class="fa fa-users" aria-hidden="true"></i><span>ACL</span></a></li>     
                                @endif    
                                
    
                                

                                

                            </ul>
                        </nav>
                    </div>
                </div>
 </div>