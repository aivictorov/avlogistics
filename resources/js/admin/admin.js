import { editor } from "./components/editor";
import { initGalleryItems } from "./components/gallery";
import { initUpdateAvatar } from "./components/avatarUpdate";
import { initDestroyImageButtons } from "./components/destroyImageBtns";
import { initSortPortfolioGallery } from "./components/portfolioSort";
import { addImagesToPortfolio } from "./components/portfolioImgs";
import { initQuestions, addNewQuestion } from "./components/questions";
import { fileinput } from "./components/inputfile";
import { addImagesToGallery } from "./components/galleryImgs";

document.addEventListener('DOMContentLoaded', function () {
    editor();
    initGalleryItems();
    initUpdateAvatar();
    initDestroyImageButtons();
    initSortPortfolioGallery();
    addImagesToPortfolio();
    initQuestions();
    addNewQuestion();
    fileinput();
    addImagesToGallery();
});