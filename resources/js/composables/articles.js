import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useArticles() {
    const articles = ref([]);
    const latestArticles = ref([]);
    const article = ref([]);
    const router = useRouter();
    const errors = ref("");
    const processing = ref(false);

    const getArticles = async () => {
        processing.value = true;
        await axios
            .get("/articles")
            .then((response) => {
                articles.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                console.log(ex.response.data.errors);
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
                article.value = [];
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

    const updateArticle = async (id) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios.put("/articles/" + id, article.value);
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

        await axios.delete("/articles/" + id);
        processing.value = false;
    };

    return {
        articles,
        article,
        errors,
        processing,
        getArticles,
        getRelatedArticles,
        latestArticles,
        getLatestArticles,
        getArticle,
        storeArticle,
        updateArticle,
        destroyArticle,
    };
}
