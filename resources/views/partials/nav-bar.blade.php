<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/') }}" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/leads') }}" aria-expanded="false">
                        <i class="mdi mdi-account-multiple"></i><span class="hide-menu">Customers</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('/leads/create') }}">New Lead</a></li>
                        <li><a href="{{ url('/leads') }}">Leads</a></li>
                        <li><a href="{{ url('/customers') }}">All Customers</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/tariffs') }}" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i><span class="hide-menu">Tariffs</span></a>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-basket"></i><span class="hide-menu">Goods</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('/good-types/create') }}">Add Good Type</a></li>
                        <li><a href="{{ url('/good-types') }}">Goods Types</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-account-multiple"></i><span class="hide-menu">Employees</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">All Employees</a></li>
                        <li><a href="">Employee Expertise</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-account"></i><span class="hide-menu">HOD</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">Agency</a></li>
                        <li><a href="">Transport</a></li>
                        <li><a href="">Logistics</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>