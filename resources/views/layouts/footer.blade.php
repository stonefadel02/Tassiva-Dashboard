<footer class="iq-footer">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><a href="#">Politique de confidentialiter</a>
                            </li>
                            <li class="list-inline-item"><a href="#">Condition d'utilisation</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 text-right">
                        <span class="mr-1">
                            <script>document.write(new Date().getFullYear())</script>©
                        </span> <a href="https://www.tassiva.shop/" class="">TASSIVA</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="{{ asset('assets/js/backend-bundle.min.js') }}"></script>

<script src="{{ asset('assets/js/table-treeview.js') }}"></script>

<!-- Chart Custom JavaScript -->
<script src="{{ asset('assets/js/customizer.js') }}"></script>

<!-- Chart Custom JavaScript -->
<script async src="{{ asset('assets/js/chart-custom.js') }}"></script>

<!-- app JavaScript -->
<script src="{{ asset('assets/js/app.js') }}"></script>

<!-- Gestion du menu -->

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const cleanPath = path => path.replace(/^\/+|\/+$/g, ''); // Nettoie les slashes

    const currentPath = cleanPath(window.location.pathname);
    const menuLinks = document.querySelectorAll('.iq-menu a');

    let matchedLink = null;

    menuLinks.forEach(link => {
      const linkHref = cleanPath(link.getAttribute('href'));

      // Active si l'URL correspond exactement
      if (linkHref === currentPath) {
        matchedLink = link;
      }
    });

    if (matchedLink) {
      // Retire la classe active partout
      document.querySelectorAll('.iq-menu li').forEach(li => li.classList.remove('active'));

      // Active l'élément parent direct
      const parentLi = matchedLink.closest('li');
      if (parentLi) parentLi.classList.add('active');

      // Ouvre les parents si c’est un sous-menu
      const subMenu = matchedLink.closest('.collapse');
      if (subMenu) {
        subMenu.classList.add('show'); // Bootstrap : affiche le sous-menu
        const parentWithToggle = subMenu.closest('li');
        if (parentWithToggle) parentWithToggle.classList.add('active');
      }
    }

    // Écoute le clic pour changer les classes "active"
    const allLinks = document.querySelectorAll('.iq-menu > li > a');

    allLinks.forEach(link => {
      link.addEventListener('click', function () {
        document.querySelectorAll('.iq-menu > li').forEach(li => li.classList.remove('active'));
        this.parentElement.classList.add('active');
      });
    });
  });
</script>

