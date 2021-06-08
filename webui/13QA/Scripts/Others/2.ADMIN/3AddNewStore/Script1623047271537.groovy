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

WebUI.click(findTestObject('Object Repository/Page_Dashboard/a_System'))

WebUI.verifyElementVisible(findTestObject('Object Repository/Page_Dashboard/a_Settings'))

WebUI.click(findTestObject('Object Repository/Page_Dashboard/a_Settings'))

WebUI.verifyElementVisible(findTestObject('Object Repository/Page_Dashboard/span_Create New Store'))

WebUI.click(findTestObject('Object Repository/Page_Dashboard/a_Create New Store'))

WebUI.setText(findTestObject('Object Repository/Page_Store Details/input_Store Name_name'), 'Cars')

WebUI.setText(findTestObject('Object Repository/Page_Store Details/input_Name Alias_alias'), 'Auto')

WebUI.setText(findTestObject('Object Repository/Page_Store Details/textarea_Visual_store_description1description'), 'welcome')

WebUI.setText(findTestObject('Object Repository/Page_Store Details/input_HTTPS_config_url'), GlobalVariable.StoreURLDefault+GlobalVariable.Store2Url)

WebUI.setText(findTestObject('Object Repository/Page_Store Details/input_HTTPS_config_ssl_url'), GlobalVariable.StoreURLDefault+GlobalVariable.Store2Url)

WebUI.click(findTestObject('Object Repository/Page_Store Details/button_Save'))

WebUI.waitForPageLoad(0)

WebUI.verifyElementPresent(findTestObject('Object Repository/Page_Settings/a_System_btn btn-primary actionitem tooltips'),
    0)

WebUI.verifyElementText(findTestObject('Object Repository/Page_Settings/div_Success You have modified settings'), 'Success: You have modified settings!')

WebUI.verifyElementVisible(findTestObject('Object Repository/Page_Settings/input_HTTPS_config_url'))

WebUI.verifyElementText(findTestObject('Object Repository/Page_Settings/button_Auto'), 'Auto')

WebUI.verifyElementAttributeValue(findTestObject('Page_Settings/input_HTTPS_config_url'), 'value', GlobalVariable.StoreURLDefault+GlobalVariable.Store2Url,
    0)

WebUI.closeBrowser()
