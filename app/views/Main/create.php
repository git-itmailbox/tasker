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
                    <input type="text" id="userName" name="userName" placeholder="" class="input-xlarge" required>
                    <p class="help-block">Username can contain any letters or numbers</p>
                </div>
            </div>

            <div class="control-group">
                <!-- E-mail -->
                <label class="control-label" for="email">E-mail</label>
                <div class="controls">
                    <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
                    <p class="help-block">Please provide your E-mail</p>
                </div>
            </div>
            <div class="control-group">
                <!-- E-mail -->
                <label class="control-label" for="description">Description</label>
                <div class="controls">
                    <textarea type="text" name="description" id="description"> </textarea>
                    <p class="help-block">Please describe your task</p>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="image">Image</label>
                <div class="controls">
                    <input class="" type="file" name="image" id="image">
                    <p class="help-block">You may upload images(png,jpg,gif)</p>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <button class="btn btn-success" type="submit">Create task</button>
                </div>
            </div>

        </fieldset>

    </form>

</div>