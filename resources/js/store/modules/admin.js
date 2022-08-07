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
        isLoading: true,
        filteredCustomers: {},
        filteredQuotes: {},
        filteredShipments: {},
        filteredStaffs: {},
        filteredPackages: [],
        isToggled: false,
        price_lists: [],
        expenses: [],
        expense_categories: [],
        call_logs: [],
        vendors: [],
        vendor_shipments: [],
        vendor_expenses: [],
        shipment_balance: 0,
        notifications:[],
        all_vendor_payments:[],
        leads:[],

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
            return state.packages;
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
        getExpenses(state) {
            return state.expenses;
        },
        getExpenseCategories(state) {
            return state.expense_categories;
        },
        getCallLogs(state) {
            return state.call_logs;
        },
        getAllVendors(state) {
            return state.vendors;
        },
        getVendorShipments(state) {
            return state.vendor_shipments;
        },
        getVendorExpenses(state) {
            return state.vendor_expenses;
        },
        getShipmentBalance(state) {
            return state.shipment_balance;
        },
        getNotifications(state) {
            return state.notifications;
        },
        getAllVendorPayment(state) {
            return state.all_vendor_payments;
        },
        getLeads(state) {
            return state.leads;
        },
    },
    mutations: {
        updateShipmentBalance(state, balance) {

            state.shipment_balance = balance;
        },
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
            // state.filteredPackages = packages;
        },
        TrackShipment(state, tracking_details) {

            state.tracking_details = tracking_details;
        },
        AddLoading(state) {
            state.isLoading = true;
        },
        RemoveLoading(state) {
            state.isLoading = false;
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

        // selectMonth(state, month) {

        //     if (month === 1) {

        //         let thisMonth = moment().format('YYYY-MM');

        //         state.filteredPackages = state.packages.filter(item => {
        //             return item.shipment_date.includes(thisMonth)
        //                 ;

        //         })

        //     } else if (month === 2) {

        //         let lastMonth = moment().subtract(1, 'months').endOf('month').format('YYYY-MM');
        //         state.filteredPackages = state.packages.filter(item => {
        //             return item.shipment_date.includes(lastMonth)
        //                 ;

        //         })
        //     } else if (month === 3) {

        //         let thisYear = moment().format('YYYY');

        //         state.filteredPackages = state.packages.filter(item => {
        //             return item.shipment_date.includes(thisYear)
        //                 ;

        //         })
        //     } else {
        //         state.filteredPackages = state.packages;
        //     }



        // },
        toggleSidebar(state) {
            state.isToggled = !state.isToggled;

        },
        retrievePriceLists(state, price_lists) {
            state.price_lists = price_lists;
        },
        RETRIEVE_EXPENSES(state, expenses) {
            state.expenses = expenses;
        },
        RETRIEVE_EXPENSE_CATEGORIES(state, expense_categories) {
            state.expense_categories = expense_categories;
        },
        RETRIEVE_CALL_LOGS(state, call_logs) {
            state.call_logs = call_logs;
        },
        RETRIEVE_ALL_VENDORS(state, vendors) {
            state.vendors = vendors;
        },
        RETRIEVE_VENDOR_SHIPMENTS(state, vendor_shipments) {
            state.vendor_shipments = vendor_shipments;
        },
        RETRIEVE_VENDOR_EXPENSES(state, vendor_expenses) {
            state.vendor_expenses = vendor_expenses;
        },
        RETRIEVE_NOTIFICATIONS(state, notifications) {
            state.notifications = notifications;
        },
        RETRIEVE_ALL_VENDOR_PAYMENTS(state, all_vendor_payments) {
            state.all_vendor_payments = all_vendor_payments;
        },
        RETRIEVE_LEADS(state, leads) {
            state.leads = leads;
        },

    },
    actions: {
        retrieveCustomers(context,payload) {
            axios
                .get(`/api/customers?searchTerm=${payload ? payload.search : ''}`)
                .then(response => (context.commit('retrieveCustomers', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveSingleCustomer(context, customer_id) {


            axios
                .get("/api/customers/" + customer_id)
                .then(response => (context.commit('retrieveSingleCustomer', response.data.data)))
                .catch(function (error) {
                    // handle error
                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveShipments(context) {

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


            axios
                .get(`/api/shipments/${invoice_id}`)
                .then(response => (context.commit('retrieveSingleShipment', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveShipmentBalanceAmount(context, invoice_id) {
            // 
            axios
                .get("/api/shipments/" + invoice_id + "/balance_amount")
                .then(response => (context.commit('retrieveShipmentBalanceAmount', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveShipmentStatus(context, invoice_id) {
            // 
            axios
                .get("/api/shipments/" + invoice_id + "/shipment_status")
                .then(response => (context.commit('retrieveShipmentStatus', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveSingleQuote(context, quote_id) {

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

            axios
                .get('/api/quotations')
                .then(response => (context.commit('retrieveQuotations', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveCustomerInvoice(context, customer_id) {

            axios
                .get(`/api/customers/${customer_id}/invoices`)
                .then(response => (context.commit('retrieveCustomerInvoice', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveCustomerPaidInvoice(context, customer_id) {

            axios
                .get(`/api/customers/${customer_id}/invoices/paid`)
                .then(response => (context.commit('retrieveCustomerInvoice', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveCustomerPendingInvoice(context, customer_id) {

            axios
                .get(`/api/customers/${customer_id}/invoices/pending`)
                .then(response => (context.commit('retrieveCustomerInvoice', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveCustomerPartialInvoice(context, customer_id) {

            axios
                .get(`/api/customers/${customer_id}/invoices/partial`)
                .then(response => (context.commit('retrieveCustomerInvoice', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveCustomerQuotes(context, customer_id) {

            axios
                .get(`/api/customers/${customer_id}/quotes`)
                .then(response => (context.commit('retrieveCustomerQuotes', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveDashboardDetails(context, customer_id) {

            axios
                .get(`/api/dashboard`)
                .then(response => (context.commit('retrieveDashboardDetails', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveStaffs(context) {

            axios
                .get(`/api/staffs`)
                .then(response => (context.commit('retrieveStaffs', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveSingleStaff(context, staff_id) {

            axios
                .get(`/api/staffs/${staff_id}`)
                .then(response => (context.commit('retrieveSingleStaff', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveAllPayments(context) {

            axios
                .get(`/api/payments`)
                .then(response => (context.commit('retrieveAllPayments', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrievePackages(context, payload) {
            console.log(`/api/packages/${payload.customer_id}/get/${payload.time}/status/${payload.status}`);
            axios
                .get(`/api/packages/${payload.customer_id}/get/${payload.time}/status/${payload.status}`)
                .then(response => {

                    // response.data.data.sort((a, b) => (a.shipment_freight_invoice_number > b.shipment_freight_invoice_number) ? 1 : ((b.shipment_freight_invoice_number > a.shipment_freight_invoice_number) ? -1 : 0));

                    (context.commit('retrievePackages', response.data.data));

                })
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        TrackShipment(context, tracking_no) {

            axios
                .get(`/api/shipments/${tracking_no}/shipment_track`)
                .then(response => (context.commit('TrackShipment', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },

        retrievePriceLists(context) {


            axios
                .get(`/api/price_lists`)
                .then(response => (context.commit('retrievePriceLists', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        RETRIEVE_EXPENSES(context) {
            axios
                .get(`/api/expenses`)
                .then(response => (context.commit('RETRIEVE_EXPENSES', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        RETRIEVE_THIS_MONTH_EXPENSES(context) {
            axios
                .get(`/api/expenses/this_month/get`)
                .then(response => (context.commit('RETRIEVE_EXPENSES', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        RETRIEVE_LAST_MONTH_EXPENSES(context) {
            axios
                .get(`/api/expenses/last_month/get`)
                .then(response => (context.commit('RETRIEVE_EXPENSES', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        RETRIEVE_EXPENSE_CATEGORIES(context) {
            axios
                .get(`/api/expense_categories`)
                .then(response => (context.commit('RETRIEVE_EXPENSE_CATEGORIES', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        RETRIEVE_CALL_LOGS(context) {
            axios
                .get(`/api/call_logs`)
                .then(response => (context.commit('RETRIEVE_CALL_LOGS', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        RETRIEVE_ALL_VENDORS(context) {
            axios
                .get(`/api/vendors/all/get`)
                .then(response => (context.commit('RETRIEVE_ALL_VENDORS', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        RETRIEVE_VENDOR_SHIPMENTS(context, vendor_id) {
            axios
                .get(`/api/vendors/${vendor_id}/get`)
                .then(response => (context.commit('RETRIEVE_VENDOR_SHIPMENTS', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        RETRIEVE_VENDOR_EXPENSES(context) {
            axios
                .get(`/api/vendor_expenses`)
                .then(response => (context.commit('RETRIEVE_VENDOR_EXPENSES', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        RETRIEVE_THIS_MONTH_VENDOR_EXPENSES(context) {
            axios
                .get(`/api/vendor_expenses/this_month/get`)
                .then(response => (context.commit('RETRIEVE_VENDOR_EXPENSES', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        RETRIEVE_LAST_MONTH_VENDOR_EXPENSES(context) {
            axios
                .get(`/api/vendor_expenses/last_month/get`)
                .then(response => (context.commit('RETRIEVE_VENDOR_EXPENSES', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        RETRIEVE_NOTIFICATIONS(context) {
            axios
                .get(`/api/undelivered_shipments`)
                .then(response => (context.commit('RETRIEVE_NOTIFICATIONS', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        RETRIEVE_ALL_VENDOR_PAYMENTS(context) {
            axios
                .get(`/api/vendor_payments`)
                .then(response => (context.commit('RETRIEVE_ALL_VENDOR_PAYMENTS', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        RETRIEVE_LEADS(context) {
            axios
                .get(`/api/leads`)
                .then(response => (context.commit('RETRIEVE_LEADS', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
    }
})