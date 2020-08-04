import { log } from "@chenfengyuan/vue-qrcode";

export default ({
    // namespaced: true,
    state: {
        customers: [],
        errors: [],
        customer: {},
        shipments: [],
        shipment: {},
        balance_amount: {},
        shipment_status: {},
        quote: {},
        quotes: [],
        customer_invoice: {},
        customer_quotes: {},
        dashboard: {},
        staffs: {},
        staff: {},
        payments: [],
        packages: [],
        tracking_details: {},
        isLoading: false,
        filteredCustomers: {},
        filteredQuotes: {},
        filteredShipments: {},
        filteredStaffs: {},
        filteredPackages: [],
        isToggled: false,
        price_lists: []

    },
    getters: {
        getAllCustomers(state) {
            return state.customers
        },
        getFilteredCustomers(state) {
            return state.filteredCustomers;
        },
        getAllErrors(state) {

            return state.errors;
        },
        getSingleCustomer(state) {
            return state.customer;
        },
        getAllShipments(state) {
            return state.shipments;
        },
        getFilteredShipments(state) {
            return state.filteredShipments;
        },
        getSingleShipment(state) {

            return state.shipment;
        },
        getShipmentBalanceAmount(state) {
            return state.balance_amount;
        },
        getShipmentStatus(state) {
            return state.shipment_status;
        },
        getSingleQuote(state) {
            return state.quote;
        },
        getAllQuotes(state) {
            return state.quotes;
        },
        getFilteredQuotes(state) {

            return state.filteredQuotes;
        },
        getCustomerInvoices(state) {
            return state.customer_invoice;
        },
        getCustomerQuotes(state) {
            return state.customer_quotes;
        },
        getDashboardDetails(state) {
            return state.dashboard;
        },
        getAllStaffs(state) {
            return state.staffs;
        },
        getFilteredStaffs(state) {
            return state.filteredStaffs;
        },
        getSingleStaff(state) {
            return state.staff;
        },
        getAllPayments(state) {
            return state.payments;
        },
        getAllPackages(state) {
            // let allPackages = state.packages;
            // allPackages.map(el => el.shipment_date = moment(el.shipment_date).format('DD/MM/YYYY'));
            return state.filteredPackages;
        },
        getTrackingDetails(state) {
            return state.tracking_details;
        },
        getIsLoading(state) {
            return state.isLoading;
        },
        getIsToggled(state) {
            return state.isToggled;
        },
        getFilteredPriceLists(state) {
            return state.price_lists;
        },
    },
    mutations: {
        retrieveCustomers(state, customers) {
            state.customers = customers;
            state.filteredCustomers = customers

        },
        retrieveSingleCustomer(state, customer) {
            state.customer = customer;
        },
        catchErrors(state, errors) {
            state.errors = errors;
        },
        clearErrors(state) {
            state.errors = {};
        },

        retrieveShipments(state, shipments) {
            state.shipments = shipments;
            state.filteredShipments = shipments;
        },
        retrieveSingleShipment(state, shipment) {

            state.shipment = shipment;
        },
        retrieveShipmentBalanceAmount(state, balance_amount) {

            state.balance_amount = balance_amount;
        },
        retrieveShipmentStatus(state, status) {

            state.shipment_status = status;
        },
        retrieveSingleQuote(state, quote) {

            state.quote = quote;
        },
        retrieveQuotations(state, quotes) {
            state.quotes = quotes;
            state.filteredQuotes = quotes;
        },
        retrieveCustomerInvoice(state, invoice) {

            state.customer_invoice = invoice;

        },
        retrieveCustomerQuotes(state, quotes) {

            state.customer_quotes = quotes;

        },
        retrieveDashboardDetails(state, dashboard) {


            state.dashboard = dashboard;

        },
        retrieveStaffs(state, staffs) {
            state.staffs = staffs;
            state.filteredStaffs = staffs;

        },
        retrieveSingleStaff(state, staff) {
            state.staff = staff;
        },
        retrieveAllPayments(state, payments) {


            state.payments = payments;
        },
        retrievePackages(state, packages) {

            state.packages = packages;
            state.filteredPackages = packages;
        },
        TrackShipment(state, tracking_details) {

            state.tracking_details = tracking_details;
        },
        ToggleIsLoading(state) {
            state.isLoading = !state.isLoading
            setTimeout(() => {
                state.isLoading = !state.isLoading
            }, 500)
        },
        searchCustomer(state, search) {

            if (search) {
                state.filteredCustomers = state.customers.filter(item => {
                    return item.name.trim().toLowerCase().includes(search.trim().toLowerCase()) ||

                        item.email.trim().toLowerCase().includes(search.trim().toLowerCase()) ||
                        item.phone.trim().toLowerCase().includes(search.trim().toLowerCase())
                        ;
                })
            }
            else {
                state.filteredCustomers = state.customers;
            }
        },
        searchShipment(state, search) {

            if (search) {
                state.filteredShipments = state.shipments.filter(item => {
                    return item.docket_no.trim().toLowerCase().includes(search.trim().toLowerCase()) ||
                        item.sender_name.trim().toLowerCase().includes(search.trim().toLowerCase())

                })
            }
            else {
                state.filteredShipments = state.shipments;
            }
        },

        searchQuote(state, search) {

            if (search) {
                state.filteredQuotes = state.quotes.filter(item => {
                    return item.quotation_no.trim().toLowerCase().includes(search.trim().toLowerCase()) ||
                        item.customer_name.trim().toLowerCase().includes(search.trim().toLowerCase());

                })
            }
            else {
                state.filteredQuotes = state.quotes;
            }
        },
        searchStaff(state, search) {
            if (search) {
                state.filteredStaffs = state.staffs.filter(item => {
                    return item.name.trim().toLowerCase().includes(search.trim().toLowerCase()) ||
                        item.email.trim().toLowerCase().includes(search.trim().toLowerCase())
                        ;

                })
            }
            else {
                state.filteredStaffs = state.staffs;
            }
        },

        selectMonth(state, month) {

            if (month === 1) {

                let thisMonth = moment().format('YYYY-MM');

                state.filteredPackages = state.packages.filter(item => {
                    return item.shipment_date.includes(thisMonth)
                        ;

                })

            } else if (month === 2) {

                let lastMonth = moment().subtract(1, 'months').endOf('month').format('YYYY-MM');
                state.filteredPackages = state.packages.filter(item => {
                    return item.shipment_date.includes(lastMonth)
                        ;

                })
            } else if (month === 3) {

                let thisYear = moment().format('YYYY');

                state.filteredPackages = state.packages.filter(item => {
                    return item.shipment_date.includes(thisYear)
                        ;

                })
            } else {
                state.filteredPackages = state.packages;
            }



        },
        toggleSidebar(state) {
            state.isToggled = !state.isToggled;

        },
        retrievePriceLists(state, price_lists) {
            state.price_lists = price_lists;
        }

    },
    actions: {
        retrieveCustomers(context) {
            context.commit('ToggleIsLoading');
            axios
                .get("/api/customers")
                .then(response => (context.commit('retrieveCustomers', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveSingleCustomer(context, customer_id) {

            context.commit('ToggleIsLoading');
            axios
                .get("/api/customers/" + customer_id)
                .then(response => (context.commit('retrieveSingleCustomer', response.data.data)))
                .catch(function (error) {
                    // handle error
                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveShipments(context) {
            context.commit('ToggleIsLoading');
            axios
                .get("/api/shipments")
                .then(response => {
                    response.data.data.sort((a, b) => (a.docket_no > b.docket_no) ? 1 : ((b.docket_no > a.docket_no) ? -1 : 0));
                    (context.commit('retrieveShipments', response.data.data));
                })
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveSingleShipment(context, invoice_id) {
            context.commit('ToggleIsLoading');

            axios
                .get(`/api/shipments/${invoice_id}`)
                .then(response => (context.commit('retrieveSingleShipment', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveShipmentBalanceAmount(context, invoice_id) {
            // context.commit('ToggleIsLoading');
            axios
                .get("/api/shipments/" + invoice_id + "/balance_amount")
                .then(response => (context.commit('retrieveShipmentBalanceAmount', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveShipmentStatus(context, invoice_id) {
            // context.commit('ToggleIsLoading');
            axios
                .get("/api/shipments/" + invoice_id + "/shipment_status")
                .then(response => (context.commit('retrieveShipmentStatus', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveSingleQuote(context, quote_id) {
            context.commit('ToggleIsLoading');
            axios
                .get("/api/quotations/" + quote_id)
                .then(response => (context.commit('retrieveSingleQuote', response.data))
                )
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },

        retrieveQuotations(context) {
            context.commit('ToggleIsLoading');
            axios
                .get('/api/quotations')
                .then(response => (context.commit('retrieveQuotations', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveCustomerInvoice(context, customer_id) {
            context.commit('ToggleIsLoading');
            axios
                .get(`/api/customers/${customer_id}/invoices`)
                .then(response => (context.commit('retrieveCustomerInvoice', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveCustomerQuotes(context, customer_id) {
            context.commit('ToggleIsLoading');
            axios
                .get(`/api/customers/${customer_id}/quotes`)
                .then(response => (context.commit('retrieveCustomerQuotes', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveDashboardDetails(context, customer_id) {
            context.commit('ToggleIsLoading');
            axios
                .get(`/api/dashboard`)
                .then(response => (context.commit('retrieveDashboardDetails', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveStaffs(context) {
            context.commit('ToggleIsLoading');
            axios
                .get(`/api/staffs`)
                .then(response => (context.commit('retrieveStaffs', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveSingleStaff(context, staff_id) {
            context.commit('ToggleIsLoading');
            axios
                .get(`/api/staffs/${staff_id}`)
                .then(response => (context.commit('retrieveSingleStaff', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveAllPayments(context) {
            context.commit('ToggleIsLoading');
            axios
                .get(`/api/payments`)
                .then(response => (context.commit('retrieveAllPayments', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrievePackages(context) {
            context.commit('ToggleIsLoading');
            axios
                .get(`/api/packages`)
                .then(response => {

                    response.data.data.sort((a, b) => (a.shipment_freight_invoice_number > b.shipment_freight_invoice_number) ? 1 : ((b.shipment_freight_invoice_number > a.shipment_freight_invoice_number) ? -1 : 0));

                    (context.commit('retrievePackages', response.data.data));

                })
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        TrackShipment(context, tracking_no) {
            context.commit('ToggleIsLoading');
            axios
                .get(`/api/shipments/${tracking_no}/shipment_track`)
                .then(response => (context.commit('TrackShipment', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },

        retrievePriceLists(context) {

            context.commit('ToggleIsLoading');
            axios
                .get(`/api/price_lists`)
                .then(response => (context.commit('retrievePriceLists', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
    }
})