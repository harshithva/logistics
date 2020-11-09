<template>
  <vue-good-table
    :columns="tableColumns1"
    :rows="shipments"
    :line-numbers="true"
    :search-options="{
      enabled: true,
      placeholder: 'Type to search',
    }"
    :pagination-options="{
      enabled: true,
      mode: 'pages',
    }"
  >
    <template slot="table-row" slot-scope="props">
      <span v-if="props.column.field == 'action'">
        <router-link
          :to="'/admin/customers/' + props.row.id"
          data-toggle="tooltip"
          data-placement="top"
          title="View Customer"
        >
          <i class="fas fa-eye text-secondary"></i>
        </router-link>
      </span>

      <span v-else>{{ props.formattedRow[props.column.field] }}</span>
    </template>
  </vue-good-table>
</template>

<script>
export default {
  props: ["shipments"],
  data() {
    return {
      tableColumns1: [
        {
          label: "Name",
          field: "name",
          sortable: true,
        },
        {
          label: "Email",
          field: "email",
        },
        {
          label: "Phone",
          field: "phone",
        },
        {
          label: "Location",
          field: "address",
        },

        {
          label: "Action",
          field: "action",
        },
      ],
    };
  },
};
</script>