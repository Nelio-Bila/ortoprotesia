import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import { usePagination } from "../components/pagination/useClientSidePagination";

export default function useNews(currentPage, rowsPerPage = 200) {
    const news = ref([]);
    const latestNews = ref([]);
    const searchedNews = ref([]);
    const advert = ref({});
    const router = useRouter();
    const errors = ref("");
    const processing = ref(false);

    const { paginatedArray, numberOfPages } = usePagination({
        rowsPerPage,
        arrayToPaginate: news,
        currentPage,
    });

    const getNews = async (page) => {
        processing.value = true;
        await axios
            .get("/news")
            .then((response) => {
                news.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                news.value = [];
                processing.value = false;
            });
    };

    const getNewsByCategory = async (category_id) => {
        processing.value = true;
        await axios
            .get("/news/category/" + category_id)
            .then((response) => {
                news.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                news.value = [];
                processing.value = false;
            });
    };

    const getLatestNews = async () => {
        processing.value = true;
        await axios
            .get("/news/latest")
            .then((response) => {
                latestNews.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                latestNews.value = [];
                processing.value = false;
            });
    };

    const getAdvert = async (id) => {
        processing.value = true;

        await axios
            .get("/news/" + id)
            .then((response) => {
                advert.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                processing.value = false;
            });
    };

    const storeNews = async (data) => {
        processing.value = true;

        errors.value = "";
        try {
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                },
            };

            await axios.post("/news/register", data, config);
            await router.push("/admin/news");
            processing.value = false;
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const updateNews = async (id, data) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios.put("/news/update/" + id, data);
            await router.push("/admin/news");
            processing.value = false;
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const destroyNews = async (id) => {
        processing.value = true;

        await axios.delete("/news/delete/" + id);
        processing.value = false;
    };

    const searchNews = async (criteria) => {
        processing.value = true;
        await axios
            .get("/news/search/" + criteria)
            .then((response) => {
                searchedNews.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                searchedNews.value = [];
                processing.value = false;
            });
    };

    return {
        getNews,
        getNewsByCategory,
        getLatestNews,
        getAdvert,
        storeNews,
        updateNews,
        destroyNews,
        searchNews,
        news: paginatedArray,
        latestNews,
        searchedNews,
        advert,
        router,
        errors,
        processing,
        numberOfPages,
    };
}
