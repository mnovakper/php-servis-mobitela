</div>
</main>
</div>
</div>


<script src="<?=ROOT?>/assets/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?=ROOT?>/assets/js/dashboard.js"></script>

<!--button active state-->
<script>
    let links = document.querySelectorAll(".nav a");
    for (var i = 0; i < links.length; i++) {
        if (window.location.href == links[i].href) {
            links[i].classList.add("active");
        }
    }
</script>

</body>
</html>
