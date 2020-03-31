<div class="modal fade" id="cellEdit" tabindex="-1" role="dialog" aria-labelledby="stepEditLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Редактирование ячейки</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group">
                        <label  class="col-form-label">Название ячейки</label>
                        <input type="text" class="form-control name" name="name" required>
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
                        <label class="col-form-label">Дедлайн*</label>
                        <div class="w-100">
                            <date-picker class="w-100" v-model="endDate">
                                <template slot="input">
                                    <input type="text" class="form-control w-100" :value="formatDate(endDate)"
                                           name="deadline" required />
                                </template>
                            </date-picker>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Редактировать</button>
                </div>
            </form>

        </div>
    </div>
</div>
