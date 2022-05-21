import { defineStore } from "pinia";

export const useUserStore = defineStore({
    id: "user",
    state: () => {
        return { user: null };
    },
    getters: {
        getUser: (state) => this.user,
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
