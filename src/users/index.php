<?php $admin = true; ?>
<?php include 'config.php'?>
<?php include '../sess.php'?>
<?php include '../assets/header.php'?>
<style>
        .dot {
            height: 10px;
            width: 10px;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
    <div class="container mt-5">
        <div class="d-flex">
            <h2 class="mb-4">Přehled uživatelů</h2>
            <div class="ms-auto">
                <a href="add-user.php" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Přidat uživatele</a>
            </div>
        </div>
        
        <div class="table-responisve">
            <table  id="user-table" class="table table-hover bg-white">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Uživatel</th>
                        <th>Email</th>
                        <th>Stav účtu</th>
                        <!-- <th>Aktivita</th> -->
                        <th>Akce</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="datatables.js"></script>
    <script>
        // Inicializace DataTables
  </script>
    <script>
        $(document).ready(function(){
            // Function to update user table
            function updateUserTable() {
                $.ajax({
                    url: "get-users-mocz.php", // URL to fetch updated user data
                    type: "GET",
                    success: function(data) {
                        $('#user-table tbody').html(data); // Update table body with fetched data
                        $('#user-table').DataTable();
                    }
                });
            }

            // Initial call to update user table
            updateUserTable();

            // Schedule update every 5 seconds
            //setInterval(updateUserTable, 5000);
        });
    </script>
</body>
</html>