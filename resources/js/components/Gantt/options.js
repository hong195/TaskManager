export const options = {
  taskMapping: {
    progress: 'percent',
  },
  maxRows: 100,
      maxHeight: 1024,
      title: {
    label: '',
        html: false,
  },
  row: {
    height: 24,
  },
  calendar: {
    hour: {
      display: false,
    },
  },
  chart: {
    progress: {
      bar: false,
    },
    expander: {
      display: true,
    },
  },
  taskList: {
    expander: {
      straight: false,
    },
    columns: [
      {
        id: 1,
        label: 'Порядковый номер',
        value: 'id',
        width: 130,
      },
      {
        id: 2,
        label: 'Наименование Задачи',
        value: 'label',
        width: 350,
        expander: true,
        html: true,
      },
    ],
  },
  locale: {
    name: 'ru',
        weekdays: 'Понедельник_Вторник_Среда_Четверг_Пятница_Суббота_Воскрсенье'.split('_'),
        weekdaysShort: 'Пон_Вт_Ср_Чт_Пт_Сб_Вс'.split('_'),
        weekdaysMin: 'Пон_Вт_Ср_Чт_Пт_Сб_Вс'.split('_'),
        months: 'Январь_Февраль_Март_Апрель_Май_Июнь_Июль_Август_Сентябрь_Октябрь_Ноябрь_Декабрь'.split('_'),
        monthsShort: 'Янв_Фев_Мар_Апрл_Май_Июнб_Июль_Авг_Сен_Окт_Нояб_Дек'.split('_'),
        Now: "",
        "X-Scale": "Zoom-X",
        "Y-Scale": "Zoom-Y",
        "Task list width": "Task list",
        "Before/After": "Expand",
        "Display task list": "Show task list"
  },
  times: {
      timeZoom: 24
  }
}

export const colors = {
  //plan color
  planColor: {
    base: {
      fill: "rgb(0, 92, 76)",
      stroke: "rgb(231, 76, 60)"
    }
  },
  //fact color
  factColor: {
    base: {
      fill: "rgb(14, 172, 81)",
      stroke: "rgb(30, 188, 97)"
    }
  },
}
