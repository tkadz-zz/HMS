<?php
include 'includes/emptyLayoutTop.inc.php';
?>

<?php
include 'includes/miniTab.inc.php';
?>


<div class="mt-4 mb-4">

        <div class="row">

            <div class="col-md-12">
                <div class="card-box -card">
                    <div class="card-header">
                        <div class="h4"> Search Patient</div>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <form class="form-group" method="POST" action="includes/searchPatient.inc.php?search">
                                <div class="row mb-12">
                                    <div class="col-md-6">
                                        <label>Search by (Name, Surname, National-ID)</label>
                                        <input minlength="3" class="form-control" type="text" name="search" placeholder="Type Prescription Here..." required>
                                        <br>
                                        <button name="btn_Search" class="btn btn-outline-primary" type="submit">Search <span class="fa fa-search"></span> </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if(isset($_GET['search'])){
                $n = new Userview();
                $n->viewSearchResults($_GET['search']);
            }
            ?>




    </div>


</div>




<?php
include 'includes/emptyLayoutBottom.inc.php';
?>

