<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/') }}" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                {{-- <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/quotations') }}" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i><span class="hide-menu">Quotations</span></a>
                </li> --}}

              {{-- <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                                        <i class="mdi mdi-account"></i><span class="hide-menu">Users</span></a>
                        <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('users.index') }}">Users</a></li>
                                <li><a href="{{ route('departments.index') }}">Departments</a></li>
                                <li><a href="{{ route('roles.index') }}">Roles</a></li>
                                <li><a href="{{ route('permissions.index') }}">Permissions</a></li>
                        </ul>
                </li> --}}
                
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/leads') }}" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i><span class="hide-menu">Leads</span></a>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/customers') }}" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i><span class="hide-menu">Customers</span></a>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/tariffs') }}" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i><span class="hide-menu">Tariffs</span></a>
                </li>
              <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                                                <i class="mdi mdi-account"></i><span class="hide-menu">Extra Services</span></a>
                        <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('/other-services') }}">Services</a></li>
                                <li><a href="{{ url('/other-services-type') }}">Service Types</a></li>
                        </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('bills-of-landing') }}" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i><span class="hide-menu">DMS</span></a>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/all-pdas') }}" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i><span class="hide-menu">PDAs</span></a>
                </li>
                {{-- <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/dms') }}" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i><span class="hide-menu">FDAs</span></a>
                </li> --}}
                <li style="display:none;"> <a class="has-arrow waves-effect waves-dark" href="{{ url('/reports') }}" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i><span class="hide-menu">Reports</span></a>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-account"></i><span class="hide-menu">HODs</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('/agency') }}">Agency</a></li>
                        {{--<li><a href="">Transport</a></li>--}}
                        {{--<li><a href="">Logistics</a></li>--}}
                    </ul>
                </li>             
            </ul>
        </nav>
    </div>
</aside>
