{{-- <ul class="nav nav-pills flex-column">
  <li class="nav-item">
    <a href="#" class="nav-link {{ $page_active === "overview" ? "active" : "" }}">Overview</span></a>
  </li>
  <hr>
  <li class="nav-item">
    <a href="#" class="nav-link {{ $page_active === "calendar" ? "active" : "" }}">Calendar</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('emails.index') }}" class="nav-link {{ $page_active === "emails" ? "active" : "" }}">Email</a>
  </li>
  <hr>
  <li class="nav-item">
    <a href="{{ route('todo.index') }}" class="nav-link {{ $page_active === "todo" ? "active" : "" }}">Todo</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('project.index') }}" class="nav-link {{ $page_active === "projects" ? "active" : "" }}">Projects</a>
  </li>
  <hr>
  <li class="nav-item">
    <a href="{{ route('client.index') }}" class="nav-link {{ $page_active === "clients" ? "active" : "" }}">Clients</a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link {{ $page_active === "quotes" ? "active" : "" }}">Quotes</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('invoice.index') }}" class="nav-link {{ $page_active === "invoices" ? "active" : "" }}">Invoices</a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link {{ $page_active === "taxes" ? "active" : "" }}">Taxes</a>
  </li>
</ul> --}}

<div id="sidebar-wrapper">
            <aside id="sidebar">
                <ul id="sidemenu" class="sidebar-nav nav nav-pills flex-column">
                    <li>
                        <a href="#">
                            <span class="sidebar-icon"><i class="fa fa-cubes"></i></span>
                            <span class="sidebar-title">Overview</span>
                        </a>
                    </li>
                    <hr>
                    <li>
                        <a class="accordion-toggle collapsed toggle-switch" data-toggle="collapse" href="#submenu-2">
                            <span class="sidebar-icon"><i class="fa fa-calendar"></i></span>
                            <span class="sidebar-title">Calendar</span>
                            <b class="caret"></b>
                        </a>
                        <ul id="submenu-2" class="panel-collapse collapse panel-switch" role="menu">
                            <li><a href="#"><i class="fa fa-caret-right"></i>Users</a></li>
                            <li><a href="#"><i class="fa fa-caret-right"></i>Roles</a></li>
                        </ul>
                    </li>
                    <li>
                      @if ($page_active == 'emails')
                        <a class="accordion-toggle collapsed toggle-switch" data-toggle="collapse" href="#emails-menu">
                            <span class="sidebar-icon"><i class="fa fa-envelope"></i></span>
                            <span class="sidebar-title">Email</span>
                            <b class="caret"></b>
                        </a>
                        <ul id="emails-menu" class="panel-collapse collapse panel-switch" role="menu">
                            @if (isset($nice_email_folders))
                              @foreach ($nice_email_folders as $key => $folder)
                                <li><a href="#"><i class="fa fa-angle-right"></i>{{ $folder }}</a></li>
                              @endforeach
                            @else
                              <li><a href="#"><i class="fa fa-angle-right"></i>Inbox</a></li>
                            @endif
                        </ul>
                      @else
                        <a href="{{ route('emails.index') }}">
                            <span class="sidebar-icon"><i class="fa fa-envelope"></i></span>
                            <span class="sidebar-title">Email</span>
                        </a>
                      @endif
                    </li>
                    <hr>
                    <li>
                        <a href="{{ route('todo.index') }}">
                            <span class="sidebar-icon"><i class="fa fa-tasks"></i></span>
                            <span class="sidebar-title">Todo</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('project.index') }}">
                            <span class="sidebar-icon"><i class="fa fa-paperclip"></i></span>
                            <span class="sidebar-title">Projects</span>
                        </a>
                    </li>
                    <hr>
                    <li>
                        <a href="{{ route('client.index') }}">
                            <span class="sidebar-icon"><i class="fa fa-users"></i></span>
                            <span class="sidebar-title">Clients</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="sidebar-icon"><i class="fa fa-briefcase"></i></span>
                            <span class="sidebar-title">Quotes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('invoice.index') }}">
                            <span class="sidebar-icon"><i class="fa fa-money"></i></span>
                            <span class="sidebar-title">Invoices</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="sidebar-icon"><i class="fa fa-institution"></i></span>
                            <span class="sidebar-title">Taxes</span>
                        </a>
                    </li>
                </ul>
            </aside>
        </div>
