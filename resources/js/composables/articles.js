import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useArticles() {
    const articles = ref([]);
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

    const getArticle = async (id) => {
        processing.value = true;

        await axios
            .get("/article/" + id)
            .then((response) => {
                article.value = response.data[0];
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
            let config = { headers: { "Content-Type": "multipart/form-data" } };

            await axios.post("/articles/register", data);
            await router.push("/articles");
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
        getArticle,
        storeArticle,
        updateArticle,
        destroyArticle,
    };
}
