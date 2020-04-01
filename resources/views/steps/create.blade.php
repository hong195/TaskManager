<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Создание новой задачи</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('step.store') }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Название задачи</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Исполнитель*</label>
                        <input type="text" class="form-control" name="person" id="person" required>
                    </div>
                    <div class="form-group">
                        <label  for="new-status" class="col-form-label">Статус*</label>
                        <select  class="status"  name="status" class="form-control">
                            <option value="">Выбирете статус*</option>
                            @foreach($cell_statuses as $status)
                                <option value="{{ $status }}">{{ __('status.'.$status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_date" class="col-form-label">Начало*</label>
                        <div class="w-100">
                            <date-picker class="w-100" v-model="startDate" :disabled-date="disableDate">
                                <template slot="input">
                                    <input type="text" class="form-control w-100" :value="formatDate(startDate)"
                                           name="start_date" required />
                                </template>
                            </date-picker>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deadline" class="col-form-label">Дедлайн*</label>
                        <div class="w-100">
                            <date-picker class="w-100" v-model="endDate" :disabled-date="disableDate">
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
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
                <input id="cell_id" type="hidden" name="cell_id" value="">
            </form>

        </div>
    </div>
</div>
