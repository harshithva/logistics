<template>
    <div>
                            <a class="nav-link" href="#" v-b-toggle.my-collapse>
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">{{notifications.length }}+</span>
                            </a>

                                <b-collapse id="my-collapse">
         <div class="dropdown-list dropdown-menu dropdown-menu-right shadow show">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <router-link  style="text-decoration: none; color: inherit;" v-for="notification in notifications" :key="notification.id" :to="'/admin/customers/'+ notification.sender_id +'/invoices/'+ notification.id+'/view'" >
                                <a class="dropdown-item d-flex align-items-center">
                                    <div class="mr-3">
                                    <div class="icon-circle bg-danger">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">{{notification.delivery_date}}</div>
                                        <span class="font-weight-bold">{{notification.docket_no}}</span><br>
                                        <span class="text-gray-800">Delivery Pending</span>
                                    </div>
                                </a>
                                </router-link>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
    </b-collapse>
    </div>
                            

</template>

<script>
import { mapGetters } from "vuex";

export default {
    created(){
            this.$store.dispatch("RETRIEVE_NOTIFICATIONS");
    },
      computed: {
    ...mapGetters({
      notifications: "getNotifications",
    }),
  }
}
</script>