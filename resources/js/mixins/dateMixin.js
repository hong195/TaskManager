export default {
  name: 'DateMixin',
  methods: {
    getTimestampFromDate(date) {
      return +new Date(date);
    },

    getTimestampDiff(startDate, endDate) {
      return this.getTimestampFromDate(endDate) - this.getTimestampFromDate(startDate)
    }
  }
}
