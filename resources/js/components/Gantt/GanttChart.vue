<template>
  <div>
    <div class="mt-5 mb-10">
      <gantt-elastic
        :options="options"
        :tasks="tasks"
      />
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
        let id = 1;
        ganttData.forEach((el, index) => {
          const item = {
            id: id,
            label: `${el.name} (${el.plan.label})`,
            start: this.getTimestampFromDate(el.plan.start),
            duration: this.getTimestampDiff(el.plan.start, el.plan.end),
            percent: 100,
            type: 'task',
            style: this.planColor,
          };

          this.tasks.push(item);

          if (el.fact) {
            this.tasks.push({
              id: ++id,
              label: `${el.name} (${el.fact.label})`,
              start: this.getTimestampFromDate(el.fact.start),
              duration: this.getTimestampDiff(el.fact.end, el.fact.start),
              percent: 100,
              style: this.factColor,
              type: 'task',
            });
          }

          ++id;

        });
      },
    },
    mounted() {
      this.blockId = this.activeBlock;
      this.fetchData();
    },
  };
</script>
