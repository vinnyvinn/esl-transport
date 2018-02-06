<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/') }}" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-account-multiple"></i><span class="hide-menu">Customers</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('/customer-request') }}">Lead</a></li>
                        <li><a href="{{ url('/customer-request') }}">Customer Request</a></li>
                        <li><a href="{{ url('/customers') }}">All Customers</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-basket"></i><span class="hide-menu">Goods</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('/good-types') }}">Good Types</a></li>
                        <li><a href="">All Goods</a></li>
                    </ul>
                </li><li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-account-multiple"></i><span class="hide-menu">Employess</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">All Employees</a></li>
                        <li><a href="">Employee Expertise</a></li>
                    </ul>
                </li><li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-account-multiple"></i><span class="hide-menu">Employess</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">All Employees</a></li>
                        <li><a href="">Employee Expertise</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>