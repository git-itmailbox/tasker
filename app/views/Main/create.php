<div class="container">

    <form action="" method="post">
        <div class="row">
            <div class="col-md-2">
                <label>Your name</label>
            </div>
            <div class="col-md-3"><input type="text" name="userName" required></div>
        </div>
        <div class="row">
            <div class="col-md-2">
               <label>Email</label>
            </div>
            <div class="col-md-3"><input type="text" name="email" required></div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label>Task text</label>
            </div>
            <div class="col-md-3"><textarea type="text" name="description" > </textarea></div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label>Image</label>
            </div>
            <div class="col-md-3"><input type="file" name="image"></div>
        </div>

        <div class="row">
            <button type="submit">Create task</button>
        </div>
    </form>

</div>