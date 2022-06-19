import { defineStore } from "pinia";

export const useUserStore = defineStore("user", {
    state: () => {
        return { user: null };
    },
    getters: {
        getUser: (state) => state.user,
    },
    actions: {
        setUser(user) {
            this.user = user;
        },
        removeUser() {
            this.user = null;
        },
    },
});
