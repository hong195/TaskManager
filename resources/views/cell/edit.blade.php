<div class="modal fade" id="stepEdit" tabindex="-1" role="dialog" aria-labelledby="stepEditLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Редактирование новой задачи</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group">
                        <label  class="col-form-label">Название задачи</label>
                        <input type="text" class="form-control name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label  class="col-form-label">Исполнитель*</label>
                        <input type="text" class="form-control person" name="person" required>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Статус*</label>
                        <select id="status" name="status" class="status form-control">
                            <option value="">Выбирете статус*</option>
                            @foreach($cell_statuses as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label  class="col-form-label">Начало*</label>
                        <input type="date" class="form-control"
                               id="start_date_val"
                               name="start_date"
                               value="" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Дедлайн*</label>
                        <input type="date" id="deadline_val"
                               class="deadline form-control" name="deadline" value="" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
                <input class="cell_id" type="hidden" name="cell_id" value="">
            </form>

        </div>
    </div>
</div>
