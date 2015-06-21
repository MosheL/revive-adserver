<?php

/*
  +---------------------------------------------------------------------------+
  | Revive Adserver                                                           |
  | http://www.revive-adserver.com                                            |
  |                                                                           |
  | Copyright: See the COPYRIGHT.txt file.                                    |
  | License: GPLv2 or later, see the LICENSE.txt file.                        |
  +---------------------------------------------------------------------------+
 */

// Main strings
$GLOBALS['strChooseSection'] = "בחר מחלקה";

// Maintenance

<<<<<<< HEAD
// Priority
$GLOBALS['strRecalculatePriority']		= "שקלל קדימויות";
$GLOBALS['strHighPriorityCampaigns']		= "מערכות פרסום בקדימות גבוהה";
$GLOBALS['strAdViewsAssigned']			= "הוקצו חשיפות";
$GLOBALS['strLowPriorityCampaigns']		= "מערכות פרסום בקדימות נמוכה";
$GLOBALS['strPredictedAdViews']			= "חשיפות צפויות";
$GLOBALS['strPriorityDaysRunning']		= "קיימים כעת {days} ימים קבילים לסטטיסטיקה, היכן ש-phpAdsNew יכולה לבסס הערכה יומית. ";
$GLOBALS['strPriorityBasedLastWeek']		= "הערכה מבוססת על נתונים מהשבוע שעבר והנוכחי.  ";
$GLOBALS['strPriorityBasedLastDays']		= "הערכה מבוססת על נתונים מהימים האחרונים.  ";
$GLOBALS['strPriorityBasedYesterday']		= "הערכה מבוססת על נתונים מאתמול.  ";
$GLOBALS['strPriorityNoData']			= "אין מספיק נתונים כדי ליצור הערכה אמינה לגבי מספר החשיפות ששרת פרסומות זה יפיק היום. יישום קדימויות יתבסס על סטטיסטיקות בזמן אמת בלבד.  ";
$GLOBALS['strPriorityEnoughAdViews']		= "צריכה להיות חשיפה מספקת כדי לספק את מטרת מערכות הפרסום בקדימות גבוהה.  ";
$GLOBALS['strPriorityNotEnoughAdViews']		= "לא ברור אם יהיו מספיק חשיפות היוא כדי לספק את המטרה במערכות הפרסום בעלות הקדימות הגבוהה. עקב כך כל מערכות הפרסום בעלות קדימות נמוכה משותקות כעת זמנית. ";


// Banner cache
$GLOBALS['strRebuildBannerCache']		= "רענן זיכרון-מטמון באנרים";
$GLOBALS['strBannerCacheExplaination']		= "זיכרון-מטמון של הבאנרים מכיל כעת העתק של קוד HTML  המשמש לתצוגה של הבאנר. על ידי שימוש בזיכרון זה ניתן להאיץ את ההפצה של הבאנרים כי קוד ה-HTML לא דורש הפקה מחודשת בכל פעם שבאנר צריך להיחשף.<br /> מכיוון שזיכרון הבאנר כולל קוד מוטבע של ה-URLs למיקום ה-".MAX_PRODUCT_NAME." והבאנרים שלו, הזיכרון צריך להתעדכן בכל פעם שה-".MAX_PRODUCT_NAME." מועבר למיקום אחר על השרת. ";
=======


>>>>>>> v3.2.1





// Priority
$GLOBALS['strRecalculatePriority'] = "שקלל קדימויות";

// Banner cache
$GLOBALS['strRebuildDeliveryCache'] = "רענן זיכרון-מטמון תפוצה";
$GLOBALS['strBannerCacheExplaination'] = "זיכרון-מטמון של הב�?נרי�? מכיל כעת העתק של קוד HTML  המשמש לתצוגה של הב�?נר. על ידי שימוש בזיכרון זה ניתן לה�?יץ �?ת ההפצה של הב�?נרי�? כי קוד ה-HTML ל�? דורש הפקה מחודשת בכל פע�? שב�?נר צריך להיחשף.<br /> מכיוון שזיכרון הב�?נר כולל קוד מוטבע של ה-URLs למיקו�? ה-{$PRODUCT_NAME} והב�?נרי�? שלו, הזיכרון צריך להתעדכן בכל פע�? שה-{$PRODUCT_NAME} מועבר למיקו�? �?חר על השרת. ";

// Cache
<<<<<<< HEAD
$GLOBALS['strCache']			= "זיכרון-מטמון תפוצה";
$GLOBALS['strAge']				= "גיל";
$GLOBALS['strRebuildDeliveryCache']			= "רענן זיכרון-מטמון תפוצה";
$GLOBALS['strDeliveryCacheExplaination']		= "
	זיכרון-מטמון תפוצה משמש להמהרת התפוצה של הבאנרים. המטמון כולל העתק של כל הבאנרים המקושרים לאיזור, מה שחוסך קריאות נוספות לבסיס הנתונים כאשר הבאנרים נקראים לתצוגה ממשית. המטמון מתחדש בכל פעם שחל שינוי לאיזור או לאחד מהבאנרים שבתוכו, ויש אפשרות שהוא ייהפך למיושן. מכאן שהוא נבנה מחדש כל שעה, אך ניתן להפעיל זאת גם ידנית.
";
$GLOBALS['strDeliveryCacheSharedMem']		= "
נעשה כעת שימוש בזכרון משותף	ל�?יחסון זכרון מטמון (cache).
";
$GLOBALS['strDeliveryCacheDatabase']		= "
	בסיס הנתוני�? משמשמ בעת ל�?יחסון מטמון הפקת הבנ�?רי�? (cache).
";
$GLOBALS['strDeliveryCacheFiles']		= "
מטמון הפקת הבנ�?רי�? (cache) מ�?וחסן כעת על כמה קבצי�? בשרת שלך.
";





// Storage
$GLOBALS['strStorage']				= "�?יחסון";
$GLOBALS['strMoveToDirectory']			= "העבר �?ת התמונות השמורות בתוך בסיס הנתוני�? �?ל תוך התיקייה.";
$GLOBALS['strStorageExplaination']		= "הב�?נרי�? בשימוש מקומי מ�?וחסני�? בתוך בסיס הנתוני�? �?ו בתיקייה על השרת. �?�? �?תה שומר �?ת הב�?נרי�? בתוך תיקייה יפחת העומס על בסיס הנתוני�? ו�?ף המהירות תו�?ץ. ";




=======
$GLOBALS['strCache'] = "זיכרון-מטמון תפוצה";
$GLOBALS['strDeliveryCacheSharedMem'] = "נעשה כעת שימוש בזכרון משותף	ל�?יחסון זכרון מטמון (cache).";
$GLOBALS['strDeliveryCacheDatabase'] = "	בסיס הנתוני�? משמשמ בעת ל�?יחסון מטמון הפקת הבנ�?רי�? (cache).";
$GLOBALS['strDeliveryCacheFiles'] = "מטמון הפקת הבנ�?רי�? (cache) מ�?וחסן כעת על כמה קבצי�? בשרת שלך.";
>>>>>>> v3.2.1

// Storage
$GLOBALS['strStorage'] = "�?יחסון";
$GLOBALS['strMoveToDirectory'] = "העבר �?ת התמונות השמורות בתוך בסיס הנתוני�? �?ל תוך התיקייה.";
$GLOBALS['strStorageExplaination'] = "הב�?נרי�? בשימוש מקומי מ�?וחסני�? בתוך בסיס הנתוני�? �?ו בתיקייה על השרת. �?�? �?תה שומר �?ת הב�?נרי�? בתוך תיקייה יפחת העומס על בסיס הנתוני�? ו�?ף המהירות תו�?ץ. ";

// Encoding

// Product Updates
$GLOBALS['strSearchingUpdates'] = "מחפש עדכוני�?. �?נ�? המתן...";
$GLOBALS['strAvailableUpdates'] = "עדכוני�? זמיני�?";
$GLOBALS['strDownloadZip'] = "הורד (.zip)";
$GLOBALS['strDownloadGZip'] = "הורד (.tar.gz)";

$GLOBALS['strUpdateAlert'] = "גירסה חדשה של {$PRODUCT_NAME} יצ�?ה ל�?ור.                 \\n\\nה�?�? �?תה רוצה מידע נוסף \\n�?ודות העדכון?";
$GLOBALS['strUpdateAlertSecurity'] = "גירסה חדשה של {$PRODUCT_NAME} יצ�?ה ל�?ור.                 \\n\\nמומלץ מ�?וד לעדכן \\nבהזדמנות הקרובה ביותר, כיוון שגירסה זו \\nמכילה תיקוניי�? בטיחוטיי�?.";

$GLOBALS['strUpdateServerDown'] = "מסיבה בלתי ידועה ל�? ניתן להשיג<br />מידע על עדכוני�? �?פשריי�?. �?נ�? נסה שוב מ�?וחר יותר.";

$GLOBALS['strNoNewVersionAvailable'] = "הגירסה שלך של {$PRODUCT_NAME} מעודכנת. �?ין כעת עידכוני�? חדשי�?";



$GLOBALS['strNewVersionAvailable'] = "<b>גירסה חדשה של {$PRODUCT_NAME}יצ�?ה ל�?ור.</b><br /> מומלץ להתקין גירסה זו, כיוון שהי  עשויה לתקן כמה בעיות קיימות ותוסיף תכונות חדשות. למידע נוסף �?ודות השדרוג �?נ�? קר�? �?ת התיועד הכלול בקבצי�? מטה. ";

$GLOBALS['strSecurityUpdate'] = "<b>מומלץ ביותר להתקין �?ת העדכון הזה בהקד�? ה�?פשרי, כיוון שהו�? מכיל מספר תיקוני �?בטחה.</b><br /> הגירסה של {$PRODUCT_NAME}, בה �?תה משתמש כעת, �?פשר שהי�? פגיעה להתקפות מסוימות ו�?ולי �?ינה מוגנת. למידע נוסף �?ודות העדכון �?נ�? קר�? �?ת התיועד הכלול בקבצי�? מטה. ";

$GLOBALS['strNotAbleToCheck'] = "	<b>כיוון שהרחבת ה-XML �?ינה קיימת על השרת שלך, {$PRODUCT_NAME} �?ינה יכולה לבדוק �?ת יצ�?ה גירסה חדשה.</b>";


$GLOBALS['strClickToVisitWebsite'] = "	לחץ כ�?ן כדי לבקר ב�?תר שלנו";
$GLOBALS['strCurrentlyUsing'] = "�?תה משתמש כעת";
$GLOBALS['strRunningOn'] = "רץ על";
$GLOBALS['strAndPlain'] = "ו";

//  Deliver Limitations
$GLOBALS['strDeliveryLimitations'] = "הגבלות תפוצה";

//  Append codes


