import static com.kms.katalon.core.checkpoint.CheckpointFactory.findCheckpoint
import static com.kms.katalon.core.testcase.TestCaseFactory.findTestCase
import static com.kms.katalon.core.testdata.TestDataFactory.findTestData
import static com.kms.katalon.core.testobject.ObjectRepository.findTestObject
import static com.kms.katalon.core.testobject.ObjectRepository.findWindowsObject
import com.kms.katalon.core.checkpoint.Checkpoint as Checkpoint
import com.kms.katalon.core.cucumber.keyword.CucumberBuiltinKeywords as CucumberKW
import com.kms.katalon.core.mobile.keyword.MobileBuiltInKeywords as Mobile
import com.kms.katalon.core.model.FailureHandling as FailureHandling
import com.kms.katalon.core.testcase.TestCase as TestCase
import com.kms.katalon.core.testdata.TestData as TestData
import com.kms.katalon.core.testng.keyword.TestNGBuiltinKeywords as TestNGKW
import com.kms.katalon.core.testobject.TestObject as TestObject
import com.kms.katalon.core.webservice.keyword.WSBuiltInKeywords as WS
import com.kms.katalon.core.webui.keyword.WebUiBuiltInKeywords as WebUI
import com.kms.katalon.core.windows.keyword.WindowsBuiltinKeywords as Windows
import internal.GlobalVariable as GlobalVariable
import org.openqa.selenium.Keys as Keys
import com.kms.katalon.core.testobject.ConditionType as ConditionType

WebUI.openBrowser('')

WebUI.navigateToUrl(GlobalVariable.StoreURLDefault + GlobalVariable.AdminURL)

WebUI.setText(findTestObject('Object Repository/0AdminTest-1/Page_Administration/input_Please enter your login details_username'),
    GlobalVariable.defaultAdminUsername)

WebUI.setEncryptedText(findTestObject('Object Repository/0AdminTest-1/Page_Administration/input_Please enter your login details_password'),
    'PblvLzUlPsM=')

WebUI.click(findTestObject('Object Repository/0AdminTest-1/Page_Administration/button_Login'))

WebUI.click(findTestObject('Object Repository/0AdminTest-1/Page_Dashboard/h5_Categories'))

WebUI.click(findTestObject('Object Repository/0AdminTest-1/Page_Categories/a_Categories_btn btn-primary tooltips'))

WebUI.setText(findTestObject('Object Repository/0AdminTest-1/Page_Categories/input_Category Name_category_description1name'),
    'New Category')

WebUI.setText(findTestObject('Object Repository/0AdminTest-1/Page_Categories/textarea_Visual_category_description1description'),
    'category description')

WebUI.setText(findTestObject('Object Repository/0AdminTest-1/Page_Categories/textarea_Meta Tag Keywords_category_descrip_9c6730'),
    'meta keyword1, meta 2')

WebUI.setText(findTestObject('Object Repository/0AdminTest-1/Page_Categories/textarea_Meta Tag Description_category_desc_a8485d'),
    'meta tag text')

WebUI.click(findTestObject('Object Repository/0AdminTest-1/Page_Categories/button_Generate'))

WebUI.verifyElementText(findTestObject('Object Repository/0AdminTest-1/Page_Categories/input_Generate_keyword'), '')

WebUI.setText(findTestObject('Object Repository/0AdminTest-1/Page_Categories/input_Sort Order_sort_order'), '2')

WebUI.click(findTestObject('Object Repository/0AdminTest-1/Page_Categories/button_Save'))

WebUI.verifyElementPresent(findTestObject('Object Repository/0AdminTest-1/Page_Categories/div_Success You have modified categories'),
    0)

WebUI.click(findTestObject('Object Repository/0AdminTest-1/Page_Categories/input_Category Name_category_description1name'))

WebUI.verifyElementText(findTestObject('Object Repository/0AdminTest-1/Page_Categories/input_Category Name_category_description1name'),
    '')

WebUI.verifyElementPresent(findTestObject('Object Repository/0AdminTest-1/Page_Categories/textarea_category description'),
    0)

WebUI.verifyElementText(findTestObject('Object Repository/0AdminTest-1/Page_Categories/textarea_meta keyword1, meta 2'),
    'meta keyword1, meta 2')

WebUI.verifyElementText(findTestObject('Object Repository/0AdminTest-1/Page_Categories/textarea_meta tag text'), 'meta tag text')

WebUI.click(findTestObject('Object Repository/0AdminTest-1/Page_Categories/input_Generate_keyword'))

WebUI.verifyElementText(findTestObject('Object Repository/0AdminTest-1/Page_Categories/input_Generate_keyword'), '')

WebUI.click(findTestObject('Object Repository/0AdminTest-1/Page_Categories/input_Sort Order_sort_order'))

WebUI.verifyElementText(findTestObject('Object Repository/0AdminTest-1/Page_Categories/input_Sort Order_sort_order'), '')

WebUI.verifyElementPresent(findTestObject('Object Repository/0AdminTest-1/Page_Categories/ul_default'), 0)

WebUI.verifyElementText(findTestObject('Object Repository/0AdminTest-1/part2/Page_Categories/div_Success You have modified categories'),
    'Success: You have modified categories!')


//verify values
TestObject CategoryFieldName = new TestObject().addProperty('css', ConditionType.EQUALS, '#editFrm_category_description1name')
categorynamevalue = WebUI.getAttribute(CategoryFieldName, 'value')
WebUI.verifyEqual(categorynamevalue, 'New Category')


TestObject CategoryFieldDescription = new TestObject().addProperty('css', ConditionType.EQUALS, '#editFrm_category_description1description')
categoryDescriptionValue = WebUI.getAttribute(CategoryFieldDescription, 'value')
WebUI.verifyEqual(categoryDescriptionValue, 'category description')


TestObject CategoryFieldMetaKeywords = new TestObject().addProperty('css', ConditionType.EQUALS, '#editFrm_category_description1meta_keywords')
categoryMetaKeywordsValue = WebUI.getAttribute(CategoryFieldMetaKeywords, 'value')
WebUI.verifyEqual(categoryMetaKeywordsValue, 'meta keyword1, meta 2')


TestObject CategoryFieldMetaDesc = new TestObject().addProperty('css', ConditionType.EQUALS, '#editFrm_category_description1meta_description')
categoryMetaDescValue = WebUI.getAttribute(CategoryFieldMetaDesc, 'value')
WebUI.verifyEqual(categoryMetaDescValue, 'meta tag text')


TestObject CategoryFieldSeo = new TestObject().addProperty('css', ConditionType.EQUALS, '#editFrm_keyword')
categorySeoValue = WebUI.getAttribute(CategoryFieldSeo, 'value')
WebUI.verifyEqual(categorySeoValue, 'new-category')

TestObject CategoryFieldSort = new TestObject().addProperty('css', ConditionType.EQUALS, '#editFrm_sort_order')
categorySortValue = WebUI.getAttribute(CategoryFieldSort, 'value')
WebUI.verifyEqual(categorySortValue, '2')





WebUI.click(findTestObject('Object Repository/0AdminTest-1/part2/Page_Categories/span_Categories'))

WebUI.setText(findTestObject('Object Repository/0AdminTest-1/part2/Page_Categories/input_icon_name'), 'new')

WebUI.sendKeys(findTestObject('0AdminTest-1/1-CategoryCreate/Page_Categories/input_icon_name'), Keys.chord(Keys.ENTER))

//locate the category element by css selector
TestObject GridLabelWithName = new TestObject().addProperty('css', ConditionType.EQUALS, 'td[aria-describedby="category_grid_name"] label.grid-parent-category')

WebUI.verifyElementText(GridLabelWithName, 'New Category')

//WebUI.verifyElementPresent(findTestObject('Object Repository/0AdminTest-1/part2/Page_Categories/label_New Category'), 0)
//WebUI.verifyElementText(findTestObject('Object Repository/0AdminTest-1/part2/Page_Categories/label_New Category'), 'New Category')

WebUI.closeBrowser()
