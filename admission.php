<?php 
require("header.php"); 
?>
            
            <div class="tm-row">
                <div class="tm-col-left"></div>
                <main class="tm-col-right">
                    <section class="tm-content">
                        <h2 class="mb-4 tm-content-title">Admission Form</h2>
                        <hr class="mb-5">
                        <form id="contact-form" action="auth.php" method="POST">
                            <div id="admission_tab">
                                <p class="mb-55">Student Details:</p>
                                    <div class="form-group mb-4">
                                        <input type="text" name="fname" class="form-control" placeholder="First Name" required="" >
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="text" name="lname" class="form-control" placeholder="Last Name" required="" >
                                    </div>
                                    <div class="form-group mb-4">
                                        <select name="gender" class="form-control" placeholder="First Name" required="">
                                            <option>Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                                    </div>
                                    <div class="text-right">
                                        <button type="button" onclick="goto_academia()" class="btn btn-big btn-primary">Next</button>
                                    </div>
                                </form>
                            </div>
                            
                            <div id="academia_tab" style="display:none">
                                <button class="btn btn-big btn-primary" onclick="goto_admission()" type="button">Back</button>
                                <hr class="mb-4">
                                <p class="mb-55">Academic Info:</p>
                                <div class="form-group mb-4">
                                    <input type="text" name="course" class="form-control" placeholder="Course Being Admitted" required="" />
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" name="yos" class="form-control" placeholder="Years of Study" required="" />
                                </div>
                                <div class="text-right">
                                    <button type="submit" name="admit" class="btn btn-big btn-primary">Admit</button>
                                </div>
                            </div>
                        </form>
                    </section>
                </main>
            </div>
        </div>
        
<script>
    function goto_admission(){
        var box1= document.getElementById('admission_tab');
        var box2= document.getElementById("academia_tab");
        box2.style.display = 'none';
        box1.style.display = 'block';
    }
    function goto_academia(){
        var box1= document.getElementById('admission_tab');
        var box2= document.getElementById("academia_tab");
        box1.style.display = 'none';
        box2.style.display = 'block';
    }
</script>

<?php
    require("footer.php");
?>