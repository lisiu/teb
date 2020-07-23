import * as React from 'react';
import {Dispatch, FC, useEffect, useRef, useState} from 'react';
import Step from "./Step";
import StepForward from "./StepForward";
import Card from "react-bootstrap/Card";
import Col from "react-bootstrap/Col";
import Form from "react-bootstrap/Form";
import Province from "./Province";
import {WizardData} from "./Wizard";
import axios from "axios";
import Endpoints from "../../sdk/endpoints";

interface Props extends Step {
    visible: boolean;
    minDate: string;
    maxDate: string;
    data: WizardData;
    setData: Dispatch<WizardData>;
}

const StepOne: FC<Props> = ({visible, minDate, maxDate, onForward, data, setData}: Props) => {
    const dateStartRef = useRef(null)
    const dateStopRef = useRef(null)
    const emailRef = useRef(null)
    const [isValid, setIsValid] = useState(false)
    const [validRange, setValidRange] = useState(true)
    const [provinces, setProvinces] = useState<string[]>([])
    useEffect(() => {
        axios.get(Endpoints.provinces()).then(result => {
            setProvinces(result.data)
            setData({...data, province: result.data[0]})
        })
    }, [])


    const validate = () => {
        const isValidRange = (!dateStartRef.current.value || !dateStopRef.current.value)
        || dateStartRef.current.value <= dateStopRef.current.value

        setValidRange(isValidRange)
        setIsValid(isValidRange
            && dateStartRef.current.checkValidity()
            && dateStopRef.current.checkValidity()
            && emailRef.current.checkValidity()
        )
    }

    const handleDateStartChange = (event) => {
        validate()
        setData({...data, dateStart: event.target.value})
    }
    const handleDateStopChange = (event) => {
        validate()
        setData({...data, dateStop: event.target.value})
    }
    const handleEmailChange = (event) => {
        validate()
        setData({...data, email: event.target.value})
    }

    if (!visible) {
        return null
    }
    return (
        <Card bg="light">
            <Card.Header as="h5">Krok 1/3</Card.Header>
            <Card.Body>
                <Form.Group className={'was-validated'}>
                    <Province provinces={provinces} data={data} setData={setData}/>
                    <br/>
                    <Form.Row>
                        <Form.Group as={Col} controlId="formGridFrom">
                            <Form.Label>Data początkowa (od {minDate})</Form.Label>
                            <Form.Control
                                required
                                ref={dateStartRef}
                                value={data.dateStart}
                                onChange={handleDateStartChange}
                                size="lg"
                                name="date-start"
                                min={minDate}
                                max={maxDate}
                                type="date"
                                placeholder="Data początkowa"
                            />
                            <Form.Text hidden={validRange} className="text-danger" id="dateStartHelpBlock">
                                Data początkowa nie może być większa od daty końcowej
                            </Form.Text>
                        </Form.Group>

                        <Form.Group as={Col} controlId="formGridTo">
                            <Form.Label>Data końcowa (do {maxDate})</Form.Label>
                            <Form.Control
                                required
                                ref={dateStopRef}
                                value={data.dateStop}
                                onChange={handleDateStopChange}
                                size="lg"
                                name="date-stop"
                                min={minDate}
                                max={maxDate}
                                type="date"
                                placeholder="Data końcowa"
                            />
                        </Form.Group>
                    </Form.Row>
                    <Form.Group controlId="formGridEmail">
                        <Form.Label>Adres e-mail w domenie .com.pl</Form.Label>
                        <Form.Control
                            required
                            ref={emailRef}
                            value={data.email}
                            onChange={handleEmailChange}
                            size="lg"
                            name="email"
                            type="email"
                            pattern=".+@.+\.com\.pl"
                        />
                    </Form.Group>
                </Form.Group>
                <StepForward disabled={!isValid} onClick={onForward}/>
            </Card.Body>
        </Card>
    )
}

export default StepOne
