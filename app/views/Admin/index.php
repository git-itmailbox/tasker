<div class="container">

    <h2>Admin panel</h2>


    <div class="row panel panel-default">
        <div class="col-md-2 col-sm-2 panel-heading">user name
            <a href="/admin/index/username/">
                <span class="glyphicon glyphicon-sort-by-alphabet"></span>
            </a>
            <a href="/admin/index/username/desc">
                <span class="glyphicon glyphicon-sort-by-alphabet-alt"></span>
            </a>
        </div>
        <div class="col-md-2 col-sm-2 panel-heading">email
            <a href="/admin/index/email/">
                <span class="glyphicon glyphicon-sort-by-alphabet"></span>
            </a>
            <a href="/admin/index/email/desc">
                <span class="glyphicon glyphicon-sort-by-alphabet-alt"></span>
            </a>
        </div>
        <div class="col-md-3 col-sm-3 panel-heading">description</div>
        <div class="col-md-3 col-sm-3 panel-heading">image</div>
        <div class="col-md-2 col-sm-2 panel-heading">is done
            <a href="/admin/index/is-done/">
                <span class="glyphicon glyphicon-sort-by-attributes"></span>
            </a>
            <a href="/admin/index/is-done/desc">
                <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
            </a>
        </div>
    </div>
    <?php if ($tasks): ?>
        <?php foreach ($tasks as $task): ?>

            <div id="task_<?= $task->id ?>" class="row  <?= ($task->is_done > 0) ? "bg-success" : "bg-info"; ?>">
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
                <div class="col-md-3 col-sm-3">
                    <?php if (!$task->image): ?>
                        <img src="/img/noimage.jpeg" class="img-responsive" alt="task image" width="100" height="100">
                    <?php endif; ?>
                    <?php if ($task->image): ?>
                        <img src="<?= $task->image ?>" class="img-responsive" alt="task image">
                    <?php endif; ?>

                </div>
                <div class="col-md-2 col-sm-2">
                    <input
                            type="checkbox"
                            class="done-trigger"
                            id="cbox_<?= $task->id ?>"
                        <?= ($task->is_done > 0) ? "checked" : ""; ?>
                    >
                    <label for="cbox_<?= $task->id ?>">Check if Done</label>
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
        $("#submitTaskEdit").on("click", updateDescription);
        $(".done-trigger").on("change", function () {
            changeTaskState(this);
        });

        $(".container").on("click", ".editTask", function () {
            description2 = $(this).closest('.row').find('.description')[0].innerText;
            $("#mdl_description").text("");
            $("#mdl_description").val(description2);
            $("#taskId").val($(this).data("id"));
            $("#modal-title").text("Edit task description #" + $(this).data("id"));
        });
    });


    function changeTaskState(e) {
        var elID = e.id.toString().split("_")
        var state = $(e).is(':checked');
        $.post(
            "/admin/update",
            {
                id: elID[1],
                is_done: state,
            },
            function (data) {
                if (data.is_done == true) {
                    $("#task_" + data.id).addClass("bg-success").removeClass("bg-info");
                }
                if (data.is_done == false) {
                    $("#task_" + data.id).removeClass("bg-success").addClass("bg-info");
                }
            },
            'JSON'
        );
    }

    function updateDescription() {

        var id = $("#taskId").val();
        var descr = $("#mdl_description").val();

        $.post("/admin/update",
            {
                //send form
                id: id,
                description: descr,
            },
            function (data) {

                console.log(data.error);
                if (data.error == undefined) {
                    console.log('smth wrong: ' + data.error);

                }
                else {
                    console.log('Task has been updated');
                    $("#myModal").modal('hide');
                    $("#task_" + data.id).find(".description").text(data.description);
                }
            },
            'JSON'
        );
    }


</script>
