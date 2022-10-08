import { defineStore } from "pinia";

export const useUserStore = defineStore("user", {
    state: () => {
        return { user: null, isHP: false, isAdmin: false, returnUrl: null };
    },
    getters: {
        get: (state) => state.user,
        getIsHP: (state) => state.isHP,
        getIsAdmin: (state) => state.isAdmin,
    },
    actions: {
        setUser(user) {
            this.user = user;
        },
        setIsHP(isHP) {
            this.isHP = isHP;
        },
        setIsAdmin(isAdmin) {
            this.isAdmin = isAdmin;
        },
        removeUser() {
            this.user = null;
        },
    },
});
