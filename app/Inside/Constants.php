<?php


namespace App\Inside;

class Constants
{
    //DataBaseName
    const USERS_DB = 'users';
    const CATEGORY_DB = 'category';
    const ADMIN_DB = 'admin';
    const GROUP_FEATURES_DB = 'group_features';
    const FEATURES_DB = 'features';
    const FEATURES_QUESTIONS_ANSWERS_DB = 'features_questions_answers';


    //Check Extension
    const PHOTO_TYPE = ["image/gif", "image/jpeg", "image/jpg", "image/png", "image/PNG", "image/GIF", 'image/*'];
    const VIDEO_TYPE = ["video/x-flv", "video/mp4", "application/x-mpegURL", "video/MP2T", "video/3gpp", "video/quicktime",
        "video/x-msvideo", "video/x-ms-wmv", "avi", "swf", "flv", "wmv", "application/octet-stream",
        "video/quicktime", "video/MP2T", "video/3gpp", "video/x-msvideo", "video/x-ms-wmv", "video/x-ms-wmv",
        "video/x-matroska", "video/mpeg", "application/x-shockwave-flash", "video/webm", "video/mov", 'video/*'];

    const AUDIO_TYPE = ["audio/mpeg", "audio/x-wav", "audio/ogg", "audio/mp4", "audio/midi", "audio/basic", "audio/adpcm", "audio//s3m", "audio/mp3",
        "audio/silk", "audio/webm", "audio/m4a"];

}
