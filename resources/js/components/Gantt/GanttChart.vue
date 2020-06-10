<template>
  <div>
    <div class="mt-5 mb-10">
      <gantt-elastic
        v-if="tasks.length"
        :options="options"
        :tasks="tasks"
      />
      <div v-else>
          Нет Задач
      </div>
    </div>

  </div>
</template>

<script>
  import GanttElastic from 'gantt-elastic';
  import DateMixin from '../../mixins/dateMixin';
  import {options, colors} from './options';

  export default {
    name: 'GanttChart',
    components: {
      'gantt-elastic': GanttElastic,
    },
    mixins: [DateMixin],
    props: {
      activeBlock: {
        type: Number,
        required: true,
      },
    },

    data() {
      return {
        disabled: false,
        blockId: '',
        tasks: [],
        options: options,
        ...colors,
      };
    },

    methods: {
      onChange(blockId) {
        this.blockId = blockId;
        this.fetchData();
      },

      fetchData() {
        this.disabled = true;

        axios.post('/gantt', {
          blockId: this.blockId,
        }).then(({data}) => {
          this.tasks = [];
          this.formGanntData(data.ganttData);
        }).then(() => {
          this.disabled = false;
        });

      },

      formGanntData(ganttData) {
        ganttData.forEach((el, index) => {
          const duration = this.getTimestampDiff(el.start, el.end),
                startDate = this.getTimestampFromDate(el.start)
          const item = {
              id: index,
              label: el.label,
              start: startDate,
              duration: duration,
              percent: 100,
              type: 'task',
              style: this.planColor,
            };
          this.tasks.push(item);
        });
      },
    },
    mounted() {
      this.blockId = this.activeBlock;
      this.fetchData();
    },
  };
</script>
