// import Vue from "vue";

// import { createStore } from "vuex";

// export default createStore({
//     state: {
//     user: null,
// }});

// const store = new Vuex.Store({
//     state,
//     getters: {
//         user: (state) => {
//             return state.user;
//         },
//     },
//     actions: {
//         user(context, user) {
//             context.commit("user", user);
//         },
//     },
//     mutations: {
//         user(state, user) {
//             state.user = user;
//         },
//     },
// });

// export default store;

import { createStore } from "vuex";

export default createStore({
    state: {
        user: null,
    },
    getters: {
        user(state) {
            return state.user;
        },
    },
    mutations: {
        user(state, user) {
            state.user = user;
        },
    },
});
