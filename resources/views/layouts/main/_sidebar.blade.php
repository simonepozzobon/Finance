<ul class="nav nav-pills flex-column">
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
</ul>
