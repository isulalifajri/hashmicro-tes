<div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard*') ? 'active' : '' }}" href="/dashboard">
          <svg class="bi"><use xlink:href="#house-fill"/></svg>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('order*') ? 'active' : '' }}" href="{{ route('order') }}">
          <svg class="bi"><use xlink:href="#cart"/></svg>
          Orders
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('product*') ? 'active' : '' }}" href="{{ route('product') }}">
          <svg class="bi"><use xlink:href="#file-earmark"/></svg>
          Products
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('customer*') ? 'active' : '' }}" href="{{ route('customer') }}">
          <svg class="bi"><use xlink:href="#people"/></svg>
          Customers
        </a>
      </li>
    </ul>


    <hr class="my-3">

    <ul class="nav flex-column mb-auto">
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('home') }}">
          <svg class="bi"><use xlink:href="#house-fill"/></svg>
          To Home
        </a>
      </li>
      <li class="nav-item">

        <form action="/logout" method="POST">
          @csrf
            <button type="submit" class="nav-link d-flex align-items-center gap-2"><svg class="bi"><use xlink:href="#door-closed"/></svg>
              Sign out</button>
        </form>
      </li>
    </ul>
  </div>