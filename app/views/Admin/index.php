<div class="container">

    <h2>Admin panel</h2>

    <div class="row">
        <div class="col-md-2 col-sm-2">user name</div>
        <div class="col-md-2 col-sm-2">email</div>
        <div class="col-md-3 col-sm-3">description</div>
        <div class="col-md-2 col-sm-2">image</div>
    </div>
    <?php if ($tasks): ?>
        <?php foreach ($tasks as $task): ?>

            <div id="task<?= $task->id ?>" class="row  <?= ($task->is_done > 0) ? "bg-success" : "bg-info"; ?>">
                <div class="col-md-2 col-sm-2">
                    <?= $task->userName ?>
                </div>
                <div class="col-md-2 col-sm-2">
                    <?= $task->email ?>
                </div>
                <div class="col-md-2  col-sm-2 description">
                    <?= $task->description ?>
                </div>
                <div class="col-md-1 col-sm-1">
                    <a href="#myModal" data-toggle="modal" data-target="#myModal" class="editTask"
                       data-id="<?= $task->id ?>">Edit</a>
                </div>
                <div class="col-md-2 col-sm-2">
                    <?= $task->image ?>
                </div>
                <div class="col-md-2 col-sm-2">
                    <input
                            type="checkbox"
                            id="cbox<?= $task->id ?>"
                        <?= ($task->is_done > 0) ? "checked" : ""; ?>
                    >
                    <label for="cbox<?= $task->id ?>">Check if Done</label>
                </div>

            </div>

        <?php endforeach; ?>
    <?php endif; ?>
</div>


<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Заголовок модального окна -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="modal-title"></h4>
            </div>
            <!-- Основное содержимое модального окна -->
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="id" id="taskId">
                    <textarea name="description" id="mdl_description" cols="50" rows="10"></textarea>
                </div>
            </div>
            <!-- Футер модального окна -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="submitTaskEdit" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#submitTaskEdit").on("click", function () {
            console.log(this);
            var id = $("#taskId").val();
            var descr = $("#mdl_description").val();

            $.post(
                "/admin/update",
                {//send form
                    id: id,
                    description: descr,
                },
                function (data) {
                    console.log(data);
                    if (data!=="") {
                        //update view
                        console.log('Task has been updated');
                        $("#myModal").modal('hide');
                    }
                    else {
                        console.log('smth wrong' + data);
                    }
                },
                'text'
            );

        });

        $(".container").on("click", ".editTask", function () {
            description2 = $(this).closest('.row').find('.description')[0].innerText;
            $("#mdl_description").text("");
            $("#mdl_description").val(description2);
            $("#taskId").val($(this).data("id"));
            $("#modal-title").text("Edit task description #" + $(this).data("id"));
        });
    });

</script>
