<ul class="nav nav-pills flex-column">
  <li class="nav-item">
    <a href="#" class="nav-link {{ $page_active === "overview" ? "active" : "" }}">Overview</span></a>
  </li>
  <hr>
  <li class="nav-item">
    <a href="#" class="nav-link {{ $page_active === "calendar" ? "active" : "" }}">Calendario</a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link {{ $page_active === "email" ? "active" : "" }}">Email</a>
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
    <a href="#" class="nav-link {{ $page_active === "clients" ? "active" : "" }}">Clienti</a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link {{ $page_active === "quotes" ? "active" : "" }}">Preventivi</a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link {{ $page_active === "bills" ? "active" : "" }}">Fatture</a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link {{ $page_active === "taxes" ? "active" : "" }}">Tasse</a>
  </li>
</ul>
