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

WebUI.openBrowser('')

WebUI.navigateToUrl(GlobalVariable.StoreURLDefault+GlobalVariable.AdminURL)

WebUI.setText(findTestObject('Object Repository/Page_Administration/input_Please enter your login details._username'), GlobalVariable.defaultAdminUsername)

WebUI.setEncryptedText(findTestObject('Object Repository/Page_Administration/input_Please enter your login details._password'), 
    'PblvLzUlPsM=')

WebUI.click(findTestObject('Object Repository/Page_Administration/button_Login'))

WebUI.waitForPageLoad(0)

WebUI.click(findTestObject('Object Repository/Page_Dashboard/a_System_1'))

WebUI.verifyElementVisible(findTestObject('Object Repository/Page_Dashboard/span_Settings'))

WebUI.click(findTestObject('Object Repository/Page_Dashboard/a_Settings'))

WebUI.verifyElementVisible(findTestObject('Object Repository/Page_Dashboard/span_Store Details'))

WebUI.click(findTestObject('Object Repository/Page_Dashboard/span_Store Details'))

WebUI.waitForPageLoad(0)

WebUI.doubleClick(findTestObject('Object Repository/Page_Settings/input_Title_config_title_1'))

WebUI.setText(findTestObject('Object Repository/Page_Settings/input_Title_config_title_1'), 'Default  Store Title')

WebUI.setText(findTestObject('Object Repository/Page_Settings/textarea_Web Store Meta Description'), 'Web Store Meta Description for store')

WebUI.setText(findTestObject('Object Repository/Page_Settings/textarea_keyword1,keyword2,keyword3'), 'keyword1,keyword2,keyword3, meta keyword4')

'Switch to visual editor'
WebUI.click(findTestObject('Object Repository/Page_Settings/a_Visual'))

WebUI.enableSmartWait()

WebUI.setText(findTestObject('Object Repository/Page_Settings/body_Welcome to web store TestingNew line'), '<strong>Welcome</strong> to web store! Testing<br>New line')

WebUI.setText(findTestObject('Object Repository/Page_Settings/input_Store Owner_config_owner'), 'Owner Name')

WebUI.setText(findTestObject('Object Repository/Page_Settings/input_Postal Code_config_postcode'), '10002')

WebUI.setText(findTestObject('Object Repository/Page_Settings/textarea_Address 1'), 'Avenue, Floor 21')

WebUI.setText(findTestObject('Object Repository/Page_Settings/input_City_config_city'), 'New York')

WebUI.setText(findTestObject('Object Repository/Page_Settings/input_Latitude_config_latitude'), '0.023423534534')

WebUI.setText(findTestObject('Object Repository/Page_Settings/input_Longitude_config_longitude'), '3.4343234')

WebUI.setText(findTestObject('Object Repository/Page_Settings/input_E-Mail_store_main_email'), 'test@abantecart.com')

WebUI.click(findTestObject('Object Repository/Page_Settings/div_----00010020030040050060070080090010001_79521f'))

WebUI.click(findTestObject('Object Repository/Page_Settings/i_Save_fa fa-save fa-fw'))

WebUI.waitForPageLoad(0)

WebUI.verifyElementAttributeValue(findTestObject('Page_Settings/input_Title_config_title_1'), 'value', 'Default  Store Title', 
    0)

WebUI.verifyElementText(findTestObject('Object Repository/Page_Settings/textarea_Web Store Meta Description for store'), 
    'Web Store Meta Description for store')

WebUI.verifyElementText(findTestObject('Object Repository/Page_Settings/textarea_keyword1,keyword2,keyword3, meta keyword4'), 
    'keyword1,keyword2,keyword3, meta keyword4')

WebUI.verifyElementAttributeValue(findTestObject('Page_Settings/input_Store Owner_config_owner'), 'value', 'Owner Name', 
    0)

WebUI.verifyElementAttributeValue(findTestObject('Page_Settings/input_Postal Code_config_postcode'), 'value', '10002', 0)

WebUI.verifyElementText(findTestObject('Object Repository/Page_Settings/textarea_Avenue, Floor 21'), 'Avenue, Floor 21')

WebUI.verifyElementAttributeValue(findTestObject('Page_Settings/input_City_config_city'), 'value', 'New York', 0)

WebUI.verifyElementAttributeValue(findTestObject('Page_Settings/input_Latitude_config_latitude'), 'value', '0.023423534534', 
    0)

WebUI.verifyElementAttributeValue(findTestObject('Page_Settings/input_Longitude_config_longitude'), 'value', '3.4343234', 
    0)

WebUI.verifyElementAttributeValue(findTestObject('Page_Settings/input_E-Mail_store_main_email'), 'value', 'test@abantecart.com', 
    0)

WebUI.closeBrowser()

