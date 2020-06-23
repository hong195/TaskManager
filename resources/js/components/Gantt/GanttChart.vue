<template>
  <div>
    <div class="mt-5 mb-10">
        <div v-if="tasks.length">
            <gantt-elastic
                :options="options"
                :tasks="tasks"
                @options-changed="optionsUpdate"
                @dynamic-style-changed="styleUpdate"
            >
                <gantt-header ref="g-header" slot="header" :options="options"></gantt-header>
            </gantt-elastic>
        </div>
        <div v-else>
          Нет Задач
      </div>
    </div>

  </div>
</template>

<script>
  import GanttElastic from 'gantt-elastic';
  import GanttHeader from "gantt-elastic-header";
  import DateMixin from '../../mixins/dateMixin';
  import {options, colors} from './options';

  export default {
    name: 'GanttChart',
    components: {
      'gantt-elastic': GanttElastic,
      'gantt-header': GanttHeader
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
        color: {
          base: {
              fill: "rgb(0, 92, 76)",
              stroke: "rgb(231, 76, 60)"
          }
        },
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
                this.color.base.fill  = this.color.base.stroke = el.color
          const item = {
              id: ++index,
              label: el.label,
              start: startDate,
              duration: duration,
              percent: 100,
              type: 'task',
              style: this.color,
            };
          this.tasks.push(item);
        });
      },
      optionsUpdate(options) {
        this.options = options;
      },
      styleUpdate(style) {
        this.dynamicStyle = style;
      }
    },
    mounted() {
      this.blockId = this.activeBlock;
      this.fetchData();
    },
  };
</script>

<style  lang="scss">
    .gantt-elastic__header-btn-recenter,
    .gantt-elastic__header-task-list-switch--wrapper,
    .gantt-elastic__header-label:nth-child(3),
    .gantt-elastic__header-label:nth-child(4),
    .gantt-elastic__header-label:nth-child(5),{
        display: none;
    }
</style>
