import { defineStore } from "pinia";

import useAuth from "../composables/auth";

const { getUser } = useAuth();

export const useUserStore = defineStore("user", {
    state: () => {
        return { user: getUser(), isHP: false, isAdmin: false };
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
            this.isAdmin = this.isAdmin;
        },
        removeUser() {
            this.user = null;
        },
    },
});
