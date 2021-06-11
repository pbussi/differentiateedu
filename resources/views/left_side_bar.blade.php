        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li>
                            <!-- User Profile-->
                            <div class="user-profile d-flex no-block dropdown m-t-20">
                                <div class="user-pic"><img src={{asset("assets/images/users/1.jpg")}} alt="users"
                                        class="rounded-circle" width="40" /></div>
                                <div class="user-content hide-menu m-l-10">
                                    <a href="#" class="" id="Userdd" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <h5 class="m-b-0 user-name font-medium">{{Auth::user()->name}} <i
                                                class="fa fa-angle-down"></i></h5>
                                        <span class="op-5 user-email">{{Auth::user()->email}}</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="Userdd">
                                        <a class="dropdown-item" href={{url("userProfile")}}/{{Auth::User()->id}}><i
                                                class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                               
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href={{url("logout")}}><i
                                                class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End User Profile-->
                        </li>
                       <!-- <li class="p-15 m-t-10"><a 
                                class="btn d-block w-100 create-btn text-white no-block d-flex align-items-center"> <span class="hide-menu m-l-5"></span></a>
                        </li> -->
                        <!-- User Profile-->

 
                        @if (Auth::user()->students->count()>0)

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href={{url("myactivities")}}  aria-expanded="false">
                                <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href={{route('pendingQuestions')}} aria-expanded="false"><i class="mdi mdi-comment-question-outline"></i><span
                                    class="hide-menu">Pending Questions</span></a></li>
                       
                        @endif                       

                     
 

                        @if (Auth::user()->teachers->count()>0)

                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href={{url("mycourses")}} aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                    class="hide-menu">Dashboard</span></a></li>  

                             <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href={{url("mycourses/archivedClasses")}} aria-expanded="false"><i class="mdi mdi-archive"></i><span
                                    class="hide-menu">My archived Classes</span></a></li>                               
                       
                        

                        @endif

              



                        
                       
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
