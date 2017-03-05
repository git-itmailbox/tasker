<div class="container">

    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <fieldset>

            <div id="legend">
                <legend class="">Create Task</legend>
            </div>
            <div class="control-group">
                <!-- Username -->
                <label class="control-label" for="userName">Username</label>
                <div class="controls">
                    <input type="text" id="userName" name="userName" placeholder="" class="input-xlarge" required
                           value="<?php echo (isset($model->userName)) ? $model->userName : ""; ?>"

                    >
                    <p class="help-block">Username can contain any letters or numbers</p>
                    <p class="has-error"><?php echo (isset($errors['userName'])) ? $errors['userName'] : ""; ?></p>

                </div>
            </div>

            <div class="control-group">
                <!-- E-mail -->
                <label class="control-label" for="email">E-mail</label>
                <div class="controls">
                    <input type="text" id="email" name="email" placeholder="" class="input-xlarge"
                           value="<?php echo (isset($model->email)) ? $model->email : ""; ?>"
                    >
                    <p class="help-block">Please provide your E-mail</p>
                    <p class="has-error"><?php echo (isset($errors['email'])) ? $errors['email'] : ""; ?></p>
                </div>
            </div>
            <div class="control-group">
                <!-- E-mail -->
                <label class="control-label" for="description">Description</label>
                <div class="controls">
                    <textarea type="text" name="description" id="description"><?php
                        echo (isset($model->description)) ? $model->description : "";
                        ?></textarea>
                    <p class="help-block">Please describe your task</p>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="image">Image</label>
                <div class="controls">
                    <input class="" type="file" name="image" id="image" onchange="document.getElementById('previewImage').src = window.URL.createObjectURL(this.files[0])">


                    <p class="help-block">You may upload images(png,jpg,gif)</p>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <a class="btn btn-info" id="preview" data-target="#myModal" href="#myModal" data-toggle="modal">Preview</a>
                    <button class="btn btn-success" type="submit">Create task</button>
                </div>
            </div>

        </fieldset>

    </form>

</div>

<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content container-fluid">
            <!-- Заголовок модального окна -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="modal-title"> Preview</h4>
            </div>
            <!-- Основное содержимое модального окна -->
            <div class="modal-body">
                <div class="row ">
                    <div class="col-md-6">
                        <div class="control-group">
                            <!-- Username -->
                            <label class="control-label" for="userName">Username</label>
                            <div class="controls">
                                <input type="text" id="previewUserName" placeholder="" class="input-xlarge" readonly>
                                <input type="text" id="previewEmail" placeholder="" class="input-xlarge" readonly>
                            </div>
                            <div class="controls">
                                <textarea type="text" id="previewDescription" cols="30" rows="5" readonly></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <img id="previewImage" width="240"/>

                    </div>
                </div>
            </div>
            <!-- Футер модального окна -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#preview").on("click", preview);


    });

    function preview() {
        console.log($("#image"));
        $("#previewUserName").val($("#userName").val());
        $("#previewEmail").val($("#email").val());
        $("#previewDescription").val($("#description").val());
//        var previewImage = document.getElementById('previewImage');
//        previewImage.src = URL.createObjectURL($("#image").target.files[0]);
    }
</script>