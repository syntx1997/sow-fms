<div class="deznav">
    <div class="deznav-scroll">
        <div class="main-profile">
            <div class="image-bx">
                <img src="{{ asset('storage/users-avatar/' . auth()->user()->avatar) }}" alt="">
                <a href="javascript:void(0);"><i class="fa fa-cog" aria-hidden="true"></i></a>
            </div>
            <h5 class="name"><span class="font-w400">Hello,</span> {{ auth()->user()->name }}</h5>
        </div>
        <ul class="metismenu" id="menu">

            <!-- Admin [Start] -->
            @if(auth()->user()->role == 'Administrator')
                <li><a href="{{ url('/dashboard/admin/index') }}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-096-dashboard"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-label first">Main Menu</li>
                <li><a href="{{ url('/dashboard/admin/pig-management') }}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-089-piggy-bank"></i>
                        <span class="nav-text">Pig Management</span>
                    </a>
                </li>
                <li><a href="{{ url('/dashboard/admin/user-management') }}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-028-user-1"></i>
                        <span class="nav-text">User Management</span>
                    </a>
                </li>
            @endif
            <!-- Admin [End] -->

            <!-- Staff [Start] -->
            @if(auth()->user()->role == 'Staff')
                <li><a href="{{ url('/dashboard/staff/index') }}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-096-dashboard"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li><a href="{{ url('/dashboard/staff/guide') }}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-book"></i>
                        <span class="nav-text">Feeding/Medication Guide</span>
                    </a>
                </li>
                <li><a href="{{ url('/dashboard/staff/pigs-assigned') }}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-089-piggy-bank"></i>
                        <span class="nav-text">Pig(s) Assigned</span>
                    </a>
                </li>
            @endif
            <!-- Staff [End] -->

        </ul>
        <div class="copyright">
            <p><strong>Sow Feeding Management System</strong> © {{ \Carbon\Carbon::parse(now())->format('Y') }} All Rights Reserved</p>
            <p class="fs-12">Made with <span class="fa fa-heart"></span> by MBC Dev Team</p>
        </div>
    </div>
</div>
