<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link <?= $_SERVER['REQUEST_URI'] === '/' ? 'text-primary' : 'text-dark' ?>" href="/">Members</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $_SERVER['REQUEST_URI'] === '/trainers' ? 'text-primary' : 'text-dark' ?>" href="/trainers">Trainers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $_SERVER['REQUEST_URI'] === '/member/create' ? 'text-primary' : 'text-dark' ?>" href="/member/create">Add Member</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $_SERVER['REQUEST_URI'] === '/trainer/create' ? 'text-primary' : 'text-dark' ?>" href="/trainer/create">Add Trainer</a>
      </li>
    </ul>
  </div>
</nav>