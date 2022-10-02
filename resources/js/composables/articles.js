import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import { usePagination } from "../components/pagination/useClientSidePagination";

export default function useArticles(currentPage, rowsPerPage = 200) {
    const articles = ref([]);
    const viewsCount = ref(0);
    const viewsTodayCount = ref(0);
    const latestArticles = ref([]);
    const searchedArticles = ref([]);
    const article = ref({});
    const router = useRouter();
    const errors = ref("");
    const processing = ref(false);

    const { paginatedArray, numberOfPages } = usePagination({
        rowsPerPage,
        arrayToPaginate: articles,
        currentPage,
    });

    const getArticles = async (page) => {
        processing.value = true;
        await axios
            .get("/articles")
            .then((response) => {
                articles.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                articles.value = [];
                processing.value = false;
            });
    };

    const getMyArticles = async (id) => {
        processing.value = true;
        await axios
            .get("/articles/me/" + id)
            .then((response) => {
                articles.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                articles.value = [];
                processing.value = false;
            });
    };

    const getMyViewsCount = async (id) => {
        processing.value = true;
        await axios
            .get("/articles/views/" + id)
            .then((response) => {
                viewsCount.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                viewsCount.value = 0;
                processing.value = false;
            });
    };
    const getMyTodayViewsCount = async (id) => {
        processing.value = true;
        await axios
            .get("/articles/views/today/" + id)
            .then((response) => {
                viewsTodayCount.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                viewsTodayCount.value = 0;
                processing.value = false;
            });
    };

    const getArticlesByCategory = async (category_id) => {
        processing.value = true;
        await axios
            .get("/articles/category/" + category_id)
            .then((response) => {
                articles.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                articles.value = [];
                processing.value = false;
            });
    };
    const getArticlesByDate = async (period) => {
        processing.value = true;
        await axios
            .get("/articles/period/" + period)
            .then((response) => {
                articles.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                articles.value = [];
                processing.value = false;
            });
    };
    const getArticlesByPopularity = async (popularity) => {
        processing.value = true;
        await axios
            .get("/articles/popularity/" + popularity)
            .then((response) => {
                articles.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                articles.value = [];
                processing.value = false;
            });
    };

    const getRelatedArticles = async (id, article) => {
        processing.value = true;
        await axios
            .get("/articles/related/" + id + "/" + article)
            .then((response) => {
                articles.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                articles.value = [];
                processing.value = false;
            });
    };

    const getLatestArticles = async () => {
        processing.value = true;
        await axios
            .get("/articles/latest")
            .then((response) => {
                latestArticles.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                latestArticles.value = [];
                processing.value = false;
            });
    };

    const getArticle = async (id) => {
        processing.value = true;

        await axios
            .get("/article/" + id)
            .then((response) => {
                article.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                processing.value = false;
            });
    };

    const storeArticle = async (data) => {
        processing.value = true;

        errors.value = "";
        try {
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                },
            };

            await axios.post("/articles/register", data, config);
            await router.push("/hp/articles");
            processing.value = false;
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const updateArticle = async (id, data) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios.put("/articles/update/" + id, data);
            await router.push("/articles");
            processing.value = false;
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const destroyArticle = async (id) => {
        processing.value = true;

        await axios.delete("/articles/delete/" + id);
        processing.value = false;
    };

    const searchArticles = async (criteria) => {
        processing.value = true;
        await axios
            .get("/articles/search/" + criteria)
            .then((response) => {
                searchedArticles.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                searchedArticles.value = [];
                processing.value = false;
            });
    };

    const incrementArticleViews = async (id) => {
        errors.value = "";
        try {
            await axios.put("/articles/increment/" + id);
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    return {
        articles: paginatedArray,
        article,
        errors,
        processing,
        numberOfPages,
        getArticles,
        getRelatedArticles,
        latestArticles,
        getLatestArticles,
        searchedArticles,
        searchArticles,
        getArticle,
        storeArticle,
        updateArticle,
        destroyArticle,
        incrementArticleViews,
        getArticlesByCategory,
        getArticlesByDate,
        getArticlesByPopularity,
        getMyArticles,
        getMyViewsCount,
        getMyTodayViewsCount,
        viewsCount,
        viewsTodayCount,
    };
}
