const sectionRegistre = document.querySelector('#registre');
const sectionLogin = document.querySelector('#login');
const registretologin = document.querySelector('#registretologin');
const logintoregistre = document.querySelector('#logintoregistre');

const CourseModel = document.querySelector('#CourseModel');
const addCoursebutt = document.querySelector('#addCourse');
const CloseCourse = document.querySelector('#closecoursemodel');
const CloseCourseCancel = document.querySelector("#closeModalBtn");

const chooseCourseType = document.querySelector('#chooseCourseType');
const videoCourseBox = document.querySelector('#videoCourseButton');
const pdfCourseBox = document.querySelector('#pdfCourseButton');
const closeChooseCourseType = document.querySelector('#closeChooseCourseType');
const closeChooseCourseTypeCancel = document.querySelector('#closeChooseCourseTypeCancel');

const fileCourseLabel = document.querySelector('label[for="File_Course"]');
const fileCourseInput = document.getElementById('File_Course');
const contenu = document.getElementById('contenuFrame');
const viewCourseButt = document.getElementById('viewCourseButt');
const coursDescriptionCont = document.getElementById('coursDescriptionCont');
const courseDesTitle = document.getElementById('courseDesTitle');
const editcourse = document.getElementById('editcoursee');
const changeProfile = document.getElementById('changeProfile');
const updateProfile = document.getElementById('updateProfile');
const cancelProfileUpdate = document.getElementById('cancelProfileUpdate');



function toggleCourseModel() {
  CourseModel.classList.toggle("hidden");
}

function toggleProfle() {
  updateProfile.classList.toggle("hidden");
}

function toggleCourseType() {
  chooseCourseType.classList.toggle("hidden");
}

function toggleCourseContenu() {
  coursDescriptionCont.classList.toggle("hidden");
  courseDesTitle.classList.toggle("hidden");
  contenu.classList.toggle("hidden");
}

if (addCoursebutt) {
  addCoursebutt.addEventListener('click', toggleCourseType);

  if(pdfCourseBox){
    pdfCourseBox.addEventListener('click', function() {
      toggleCourseModel();
      document.getElementById('typecourse').value = 'pdf';
      fileCourseLabel.textContent = 'Course File (PDF)';
      fileCourseInput.accept = '.pdf';
    });
  }

  if(videoCourseBox){
    videoCourseBox.addEventListener('click', function() {
      toggleCourseModel();
      document.getElementById('typecourse').value = 'Video';
      fileCourseLabel.textContent = 'Course File (Video)';
      fileCourseInput.accept = '.mp4, .avi, .mov';
    });
  }
}

if(editcourse){
  editcourse.addEventListener('click', function(event) {
    event.preventDefault(); 
    toggleCourseModel();
  });
}

if(changeProfile){
  changeProfile.addEventListener('click', toggleProfle);
}

if(cancelProfileUpdate){
  cancelProfileUpdate.addEventListener('click', toggleProfle);

}


if (closeChooseCourseType || closeChooseCourseTypeCancel) {
  closeChooseCourseType.addEventListener('click', toggleCourseType);
  closeChooseCourseTypeCancel.addEventListener('click', toggleCourseType);
}

if (CloseCourse || CloseCourseCancel) {
  CloseCourse.addEventListener('click', toggleCourseType);
  CloseCourse.addEventListener('click', toggleCourseModel);
  CloseCourseCancel.addEventListener('click', toggleCourseType);
  CloseCourseCancel.addEventListener('click', toggleCourseModel);
}

function toggleSections(event) {
  event.preventDefault();
  sectionLogin.classList.toggle("hidden");
  sectionRegistre.classList.toggle("hidden");
}


if(viewCourseButt){
  viewCourseButt.addEventListener('click', toggleCourseContenu);
}

if (registretologin) {
  registretologin.addEventListener('click', toggleSections);
}

if (logintoregistre) {
  logintoregistre.addEventListener('click', toggleSections);
}

function confirmDelete() {
  return confirm("Are you sure you want to delete this course? This action cannot be undone.");
}

