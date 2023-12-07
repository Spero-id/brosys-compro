<link rel="stylesheet" href="../css/Navbar.css">
<nav class="navbar navbar-expand-lg bg-body-tertiary" id="Navbar">
    <div class="container-fluid">
      {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> --}}
      <div class="navbar-collapse" id="navbarText">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-md-4 gap-3">
          <li class="nav-item">
            <a class="nav-link px-3 py-1 active" aria-current="page" href="#sect-1"><p class="mb-0">Home</p></a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-3 py-1" href="#sect-3"><p class="mb-0">Profile</p></a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-3 py-1" href="#sect-5"><p class="mb-0">Event</p></a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-3 py-1" href="#sect-6"><p class="mb-0">Lorem Ipsum</p></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Dapatkan semua elemen nav-link
      var navLinks = document.querySelectorAll('.nav-link');
  
      // Tambahkan event listener untuk setiap elemen nav-link
      navLinks.forEach(function (link) {
        link.addEventListener('click', function () {
          // Hapus kelas active dari semua elemen nav-link
          navLinks.forEach(function (innerLink) {
            innerLink.classList.remove('nav-active');
          });
  
          // Tambahkan kelas nav-active ke elemen yang diklik
          link.classList.add('nav-active');
        });
      });
    });
  </script>