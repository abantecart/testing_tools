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
import com.kms.katalon.core.testobject.ConditionType
import org.openqa.selenium.Keys as Keys

WebUI.openBrowser('')

WebUI.navigateToUrl(GlobalVariable.StoreURLDefault+GlobalVariable.AdminURL)

WebUI.setText(findTestObject('0AdminTest-1/1-CategoryCreate/Page_Administration/input_Please enter your login details_username'),
    GlobalVariable.defaultAdminUsername)

WebUI.setEncryptedText(findTestObject('0AdminTest-1/1-CategoryCreate/Page_Administration/input_Please enter your login details_password'),
    'PblvLzUlPsM=')

WebUI.click(findTestObject('0AdminTest-1/3-CreateBrand/Page_Administration/button_Login'))

WebUI.click(findTestObject('0AdminTest-1/3-CreateBrand/Page_Dashboard/h5_Brands'))

WebUI.click(findTestObject('0AdminTest-1/3-CreateBrand/Page_Brands/a_Brands_btn btn-primary lock-on-click tooltips'))

WebUI.setText(findTestObject('0AdminTest-1/3-CreateBrand/Page_Brands/input_Brand Name_name'), 'New brand name')

WebUI.click(findTestObject('0AdminTest-1/3-CreateBrand/Page_Brands/button_Generate'))

WebUI.setText(findTestObject('0AdminTest-1/3-CreateBrand/Page_Brands/input_Sort Order_sort_order'), '2')

WebUI.click(findTestObject('0AdminTest-1/3-CreateBrand/Page_Brands/button_Save'))

WebUI.verifyElementPresent(findTestObject('0AdminTest-1/3-CreateBrand/Page_Brands/div_Success You have modified brands'),
    0)

//check the message
WebUI.verifyElementText(findTestObject('0AdminTest-1/3-CreateBrand/Page_Brands/div_Success You have modified brands'),
    'Success: You have modified brands!')


//verify values
brandnamevalue = WebUI.getAttribute(findTestObject('0AdminTest-1/3-CreateBrand/Page_Brands/input_Brand Name_name'), 'value')
WebUI.verifyEqual(brandnamevalue, 'New brand name')

seokeyvalue = WebUI.getAttribute(findTestObject('0AdminTest-1/3-CreateBrand/Page_Brands/input_Generate_keyword'), 'value')
WebUI.verifyEqual(seokeyvalue, 'new-brand-name')

sortvalue = WebUI.getAttribute(findTestObject('0AdminTest-1/3-CreateBrand/Page_Brands/input_Sort Order_sort_order'), 'value')
WebUI.verifyEqual(sortvalue, '2')


//check the grid. New brand must be present
WebUI.click(findTestObject('0AdminTest-1/3-CreateBrand/Page_Brands/span_Brands'))

WebUI.setText(findTestObject('0AdminTest-1/3-CreateBrand/Page_Brands/input_Action_name'), 'new')

WebUI.sendKeys(findTestObject('0AdminTest-1/3-CreateBrand/Page_Brands/input_Action_name'), Keys.chord(Keys.ENTER))

WebUI.delay(1)

//locate the element by css selector
TestObject GridElementWithName = new TestObject().addProperty('css', ConditionType.EQUALS, 'input[data-orgvalue="New brand name"]')

WebUI.click(GridElementWithName)

//recorder element will fail
//WebUI.verifyElementPresent(findTestObject('0AdminTest-1/3-CreateBrand/Page_Brands/input_Action_name21'), 0)

WebUI.closeBrowser()
