<?php
/**
 * Created by PhpStorm.
 * User: Kaspars
 * Date: 4/3/2018
 * Time: 20:38
 */

?>


<div class="row justify-content-center">
    <div class="col-sm-6 col-xs-12">
        <div id="login-container" class="jumbotron">
            <div class="display-4">
                <h1>Test your IQ | Approved by Jerry</h1>
            </div>
            <em>Jerry from Accountant</em>
            <hr class="my-2">
            <div class="row justify-content-left">
                <div class="col-sm-5 col-xs-10">
                    <div class="form-group">
                        <label for="user_name" class="control-label">Your name: </label>
                        <input type="text" id="user_name" class="form-control" placeholder="Your name">
                    </div>
                    <div class="form-group">
                        <label for="test_id" class="control-label">Your name: </label>
                        <select id="test_id" class="form-control">
                            <?php
                                foreach ($response["params"]["tests"] as $test){
                                    echo "<option value='{$test["test_id"]}'>{$test["test_name"]}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-custom" id="start-test">start test</button>
                    </div>
                </div>
                <div class="col-sm-5 col-xs-10">
                    <h4>Instructions</h4>
                    <ul>
                        <li><i class="fas fa-check"></i>
                            Enter your name</li>
                        <li><i class="fas fa-check"></i>
                            Choose your test
                        </li>
                        <li><i class="fas fa-check"></i>
                            Share with friends your disappointment
                        </li>
                    </ul>
                </div>
            </div>

            <div class="small-footer">
                <p>Powered by <i class="fab fa-first-order"></i></p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){



        $("#start-test").on("click", function(){

            var userName = $("#user_name").val();

            if(userName == "" || userName.length <= 1) {
                showError("No name", "You don't have a name or it is ridiculously small!");
                return;
            }

            if(userName.length > 60) {
                showError("Once more?", "Blame parents. But this name is too long.");
            }

            showSuccess("SUCCESS", "We are preparing your test!");


            $.ajax({
                url: "/user",
                type: "POST",
                data: {"user_name":userName, "test_id": $("#test_id").val(), "hash": "<?php echo $response["params"]["hash"];?>"},
                success: function(r) {

                    var res = JSON.parse(r);

                    if(res["success"]) {
                        hideSuccess();
                        window.location.replace("/test/<?php echo $response["params"]["hash"];?>");
                    } else {
                        hideSuccess();
                        showError("UPSSS!", "Something wrong with your test! Please don't try again!");
                    }
                },
                fail: function(r){
                    console.log("failed");
                    console.log(r);
                }
            })


        });

    });
</script>




